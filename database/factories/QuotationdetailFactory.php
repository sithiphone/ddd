<?php

use Faker\Generator as Faker;

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

$factory->define(App\Quotationdetail::class, function (Faker $faker) {
    return [
        'item' => $faker->paragraph(1),
        'descript' => $faker->paragraph(),
        'amount' => $faker->numberBetween(1, 10),
        'price' => $faker->numberBetween(5000, 10000),
        'quotation_id' => \App\Quotation::all()->random()->id,
    ];
});


