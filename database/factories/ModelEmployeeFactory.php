<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Employee::class, function (Faker $faker) {
    return [
        'name'=>$faker->unique()->name,
        'ssn'=>$faker->numberBetween(100000,9999999) . '',
        'phone'=>$faker->numberBetween(10000,100000) . '',
        'email'=>$faker->unique()->safeEmail.'',
        'establishment'=>$faker->word,
    ];
});
