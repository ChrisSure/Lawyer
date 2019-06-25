<?php

namespace App\Common\Entity;

use Illuminate\Database\Eloquent\Model;


class Reverse extends Model
{
    public const STATUS_UNREAD = 'unread';
    public const STATUS_READ = 'read';

    protected $table = 'reverse';

    protected $fillable = [
        'name', 'text', 'status', 'user_id'
    ];

    public static function new($user_id = null, $name, $text): self
    {
        return static::create([
            'user_id' => $user_id,
            'name' => $name,
            'text' => $text,
            'status' => self::STATUS_UNREAD
        ]);
    }

    public function user()
    {
        return $this->belongsTo(\App\Common\Entity\User::class, 'user_id', 'id');
    }

    public function isUnRead(): bool
    {
        return $this->status === self::STATUS_UNREAD;
    }

    public function isRead(): bool
    {
        return $this->status === self::STATUS_READ;
    }

    public function verify()
    {
        if (!$this->isUnRead()) {
            throw new \DomainException('Reverse letter is already verified.');
        }

        $this->update([
            'status' => self::STATUS_READ,
        ]);
    }

}