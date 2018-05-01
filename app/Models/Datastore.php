<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datastore extends Model
{
    public $timestamps = false;

    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class);
    }
    public function additems()
    {
        return $this->hasMany(\App\Models\Additem::class);
    }
}
