<?php

use App\Common\Entity\Articles;
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

$factory->define(Articles::class, function (Faker $faker) {
    $active = $faker->boolean;
    static $number = 1;
    return [
        'author_id' => $number++,
        'name' => $faker->name,
        'text' => $faker->text,
        'description' => $faker->text,
        'status' => $active ? Articles::STATUS_ACTIVE : Articles::STATUS_WAIT,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});