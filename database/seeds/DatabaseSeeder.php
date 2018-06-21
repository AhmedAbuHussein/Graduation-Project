<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // factory(\App\User::class,10);
      //  factory(\App\Models\Datastore::class,50)->create();
        //factory(\App\Models\Additem::class,120)->create();
        //factory(\App\Models\Employee::class,50)->create();
        factory(\App\Models\Covenant::class,150)->create();
    }
}
