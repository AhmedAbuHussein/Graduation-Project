<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Additem;
use App\User;
use App\Models\Covenant;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Edititem;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile($id){
        $user = User::find($id);
        if(!$user){
            $user = Auth::user();
        }
        $additems = Additem::where('user_id','=',$user->id)->orderBy('date','DESC')->paginate($perPage = 12, $columns = ['*'], $pageName = 'items');
        $covenant = Covenant::where('user_id','=',$user->id)->orderBy('date','DESC')->paginate($perPage = 12, $columns = ['*'], $pageName = 'cove');
        $edits  = Edititem:: where('user_id','=',$user->id)->orderBy('id','DESC')->paginate($perPage = 12, $columns = ['*'], $pageName = 'edits');
        $arr = array(
            'title'=>'الملف الشخصي',
            'user'=>$user,
            'data'=>$additems,
            'covenants'=>$covenant,
            'edits'=>$edits,
        );

        return view('profile',$arr);
    }

    

    public function sendsms(Request $req){
        $user = User::find($req->user_id);
        $msg = $req->msg;
        $user->notify(new \App\Notifications\SMSNotification($msg));
        return redirect('dashboard'); 
    }

}
