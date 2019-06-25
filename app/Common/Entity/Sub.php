<?php

namespace App\Common\Entity;

use Illuminate\Database\Eloquent\Model;


class Sub extends Model
{

    protected $table = 'sub';

    protected $fillable = [
        'email'
    ];

    public static function new($email): self
    {
        return static::create([
            'email' => $email,
        ]);
    }
}