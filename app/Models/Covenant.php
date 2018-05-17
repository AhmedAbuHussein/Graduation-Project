<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Covenant extends Model
{
    public $timestamps = false;
    public $fillable = [
        'quantity','employee_id','datastore_id','user_id','date'
    ];

    public function employee(){
        return $this->belongsTo('Employee');
    }

    public function user(){
        return $this->belongsTo(\App\User::class);
    }

    public function datastore(){
        return $this->belongsTo(\App\Models\Datastore::class);
    }

}
