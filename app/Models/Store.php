<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function users()
    {
        return $this->hasMany(\App\User::class);
    }
    public function datastores(){
        return $this->hasMany(\App\Models\Datastore::class);
    }
}
