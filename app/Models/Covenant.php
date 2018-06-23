<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Covenant extends Model
{
    public $timestamps = false;
    public $fillable = [
        'quantity','employee_id','datastore_id','user_id','date'
    ];

    public function employee(){
        return $this->belongsTo(\App\Models\Employee::class);
    }

    public function user(){
        return $this->belongsTo(\App\User::class);
    }

    public function datastore(){
        return $this->belongsTo(\App\Models\Datastore::class);
    }

}
