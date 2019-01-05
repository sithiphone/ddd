<?php

use Faker\Generator as Faker;
use App\Buydetail;
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

$factory->define(App\Buydetail::class, function (Faker $faker) {
    return [
        'name' => \App\Product::all()->random()->name,
        'amount' => $faker->numberBetween(1, 20),
        'price' => \App\Product::all()->random()->price,
        'status' => $faker->numberBetween(0,1),
        'buy_id' => \App\Buy::all()->random()->id,
    ];
});


