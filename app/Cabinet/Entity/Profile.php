<?php

namespace App\Cabinet\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'firstname', 'lastname', 'surname', 'address', 'phone', 'user_id'
    ];

    public static function new($id): self
    {
        return static::create([
            'user_id' => $id
        ]);
    }

    public function edit($firstname, $lastname, $surname, $address, $phone): void
    {
        $this->update([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'surname' => $surname,
            'address' => $address,
            'phone' => $phone
        ]);
    }

}