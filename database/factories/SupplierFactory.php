<?php

use Faker\Generator as Faker;
use App\Supplier;
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

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'mobile1' => $faker->unique()->phoneNumber,
        'mobile2' => $faker->unique()->phoneNumber,
        'email' => $faker->unique()->email,
        'address' => $faker->unique()->address,
    ];
});


