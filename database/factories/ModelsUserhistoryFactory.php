<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Models\Userhistory::class, function (Faker $faker) {
    return [
        "user_id"=>function(){
            return User::all()->random();
        },
        'additem_id'=> function(){
            return \App\Models\Additem::all()->random();
        },
        "date" =>$faker->date
    ];
});
