<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'role',
        'job_name',
        'address',
        'phone',
        'store_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    public function additem()
    {
        return $this->hasMany(\App\Models\Additem::class);
    }

    public function userhistories(){
        return $this->hasMany(\App\Models\Userhistory::class);
    }

}   
