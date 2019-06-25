<?php

namespace App\Common\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class Articles extends Model
{
    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name', 'text', 'description', 'status', 'author_id'
    ];

    public static function statusList(): array
    {
        return [
            self::STATUS_WAIT => 'Wait',
            self::STATUS_ACTIVE => 'Active'
        ];
    }

    public static function new($name, $text, $description): self
    {
        return static::create([
            'author_id' => (Auth::check()) ? Auth::id() : null,
            'name' => $name,
            'text' => $text,
            'description' => $description,
            'status' => Articles::STATUS_WAIT
        ]);
    }

    public function edit($name, $text, $description): void
    {
        $this->update([
            'name' => $name,
            'text' => $text,
            'description' => $description
        ]);
    }

    public function author()
    {
        return $this->belongsTo(\App\Common\Entity\User::class, 'author_id', 'id');
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function verify()
    {
        if (!$this->isWait()) {
            throw new \DomainException('Articles is already verified.');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function unverify()
    {
        if (!$this->isActive()) {
            throw new \DomainException('Articles is already wait.');
        }

        $this->update([
            'status' => self::STATUS_WAIT,
        ]);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', Articles::STATUS_ACTIVE);
    }

    public function scopeMy(Builder $query)
    {
        return $query->where('author_id', Auth::id());
    }

}