<?php

use Faker\Generator as Faker;
use App\Models\Datastore;
use App\User;

$factory->define(App\Models\Additem::class, function (Faker $faker) {
    return [
        'source'=> $faker->word,
        'quantity'=>$faker->numberBetween(50,100),
        'price'=> $faker->numberBetween(100,3000),
        'permision'=> $faker->numberBetween(0,300) . $faker->word,
        'datastore_id'=>function(){
            return Datastore::all()->random();
        },
        'user_id'=>function(){
            return User::all()->random();
        }
    ];
});
