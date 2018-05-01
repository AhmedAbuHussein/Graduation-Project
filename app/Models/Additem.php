<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additem extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    public function datastore()
    {
        return $this->belongsTo(\App\Models\Datastore::class);
    }

    public function userhistories()
    {
        return $this->hasMany(\App\Models\Userhistory::class);
    }
}
