<?php

use Faker\Generator as Faker;
use App\Models\Employee;

$factory->define(App\Models\Covenant::class, function (Faker $faker) {
    return [
        'quantity'=>$faker->numberbetween(10,100),
        'employee_id'=>function(){
            return Employee::all()->random();
        },
        'datastore_id'=>function(){
            return \App\Models\Datastore::all()->random();
        },
        'user_id'=>function(){
            return \App\User::all()->random();
        },
        'date'=>$faker->date(),
    ];
});
