<?php

use App\Admin\Entity\Mail;
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

$factory->define(Mail::class, function (Faker $faker) {
    return [
        'text' => $faker->text,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});