<?php

use App\Common\Entity\Reverse;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Reverse::class, function (Faker $faker) {
    $active = $faker->boolean;
    static $number = 1;
    return [
        'user_id' => $number ++,
        'name' => $faker->name,
        'text' => $faker->text,
        'status' => $active ? Reverse::STATUS_READ : Reverse::STATUS_UNREAD,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});