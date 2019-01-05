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

$factory->define(App\Quotation::class, function (Faker $faker) {
    static $code = '3D';
    return [
        'code' => $code . $faker->buildingNumber,
        'customer_id' => \App\Customer::all()->random()->id,
        'user_id' => \App\User::all()->random()->id,
    ];
});


