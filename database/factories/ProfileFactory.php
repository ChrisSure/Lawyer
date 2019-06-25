<?php

use App\Cabinet\Entity\Profile;
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

$factory->define(Profile::class, function (Faker $faker) {

    static $number = 1;

    return [
        'user_id' => $number ++,
        'firstname' => $faker->name,
        'lastname' => $faker->name,
        'surname' => $faker->name,
        'address' => $faker->name,
        'phone' => $faker->name,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});