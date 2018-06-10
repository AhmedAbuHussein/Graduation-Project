<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Edititem extends Model
{
    public $timestamps = false;
    public $fillable = [
        'source','permision','quantity','price','store_id','additem_id','user_id'
    ];


    public function user(){
        return $this->belongsTo(\App\User::class);
    }

    public function additem(){
        return $this->belongsTo(\App\Models\Additem::class);
    }
    public function store(){
        return $this->belongsTo(\App\Models\Store::class);
    }
}
