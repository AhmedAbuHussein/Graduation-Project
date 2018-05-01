<?php

use Faker\Generator as Faker;
use App\Models\Store;

$factory->define(App\Models\Datastore::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'quantity' => $faker->numberBetween(100,1000),
        'store_id' =>function(){
            return Store::all()->random();
        }
    ];
});
