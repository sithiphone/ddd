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

$factory->define(App\Bill::class, function (Faker $faker) {
    static $bath = 245;
    static $rate_id = 1;
    return [
        'bill_rate' => $bath,
        'user_id' => \App\User::all()->random()->id,
        'customer_id' => \App\Customer::all()->random()->id,
        'rate_id' => $rate_id,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
        'status_id' => \App\Bill_status::all()->random()->id,
    ];
});


