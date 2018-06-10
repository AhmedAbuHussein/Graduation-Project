<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function get(Request $req){
        return [Auth::user()->notifications,Auth::user()->store->name];
    }
}
