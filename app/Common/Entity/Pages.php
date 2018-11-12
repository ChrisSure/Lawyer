<?php

namespace App\Common\Entity;

use Illuminate\Database\Eloquent\Model;


class Pages extends Model
{
    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name', 'text', 'description', 'status'
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
            'name' => $name,
            'text' => $text,
            'description' => $description,
            'status' => Pages::STATUS_WAIT
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

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('Pages is already verified.');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public function unverify(): void
    {
        if (!$this->isActive()) {
            throw new \DomainException('Pages is already unverified.');
        }

        $this->update([
            'status' => self::STATUS_WAIT
        ]);
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', Pages::STATUS_ACTIVE);
    }

}