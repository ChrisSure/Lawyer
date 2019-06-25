<?php

namespace App\Admin\Entity;

use Illuminate\Database\Eloquent\Model;


class Mail extends Model
{
    protected $table = 'mail';

    protected $fillable = [
        'text'
    ];

    public static function new($text): self
    {
        return static::create([
            'text' => $text
        ]);
    }
}