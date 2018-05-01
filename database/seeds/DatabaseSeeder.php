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
        // $this->call(UsersTableSeeder::class);
       // factory(\App\Models\Datastore::class,50)->create();
       // factory(\App\Models\Additem::class,120)->create();
        factory(\App\Models\Userhistory::class,120)->create();
    }
}
