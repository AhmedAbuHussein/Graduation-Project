<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    public $fillable = [
        'name','ssn','phone','email','establishment'
    ];

    public function covenants(){
        return $this->hasMany(\App\Models\Covenant::class);
    }

}
