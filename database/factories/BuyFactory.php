<?php

use Faker\Generator as Faker;
use App\Buy;
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

$factory->define(App\Buy::class, function (Faker $faker) {
    static $zero = 0;
    return [
        'code' => $faker->unique()->numberBetween(10,100),
        'user_id' => \App\User::all()->random()->id,
        'supplier_id' => \App\Supplier::all()->random()->id,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
        'status' => $zero,
    ];
});


