<?php

use Faker\Generator as Faker;
use App\Categories;
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

$factory->define(App\Product::class, function (Faker $faker) {
    static $password;
    static $photo = 'no_photo.jpg';

    return [
        'code' => $faker->unique()->postcode,
        'name' => $faker->paragraph(2),
        'photo' => $photo,
        'price' => $faker->numberBetween(2000, 50000),
        'category_id' => \App\Categories::all()->random()->id,
    ];
});


