<?php

namespace App\Site\Entity;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $user_id
 * @property string $network
 * @property string $identity
 */

class State extends Model
{

    public const STATUS_WAIT = 'wait';
    public const STATUS_PAID = 'paid';

    protected $table = 'state';

    protected $fillable = ['user_id', 'path', 'sum', 'status'];


    public static function new($filename, $sum, $user_id): self
    {
        return static::create([
            'path' => $filename,
            'user_id' => $user_id,
            'sum' => $sum,
            'status' => self::STATUS_WAIT
        ]);
    }

    public function paid(): void
    {
        $this->update([
            'status' => self::STATUS_PAID
        ]);
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isPaid(): bool
    {
        return $this->status === self::STATUS_PAID;
    }

}