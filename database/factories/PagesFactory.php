<?php

use App\Common\Entity\Pages;
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

$factory->define(Pages::class, function (Faker $faker) {
    $active = $faker->boolean;
    return [
        'name' => $faker->name,
        'text' => $faker->text,
        'description' => $faker->text,
        'status' => $active ? Pages::STATUS_ACTIVE : Pages::STATUS_WAIT,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});