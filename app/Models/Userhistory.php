<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userhistory extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'additem_id',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function additem()
    {
        return $this->belongsTo(\App\Models\Additem::class);
    }
}
