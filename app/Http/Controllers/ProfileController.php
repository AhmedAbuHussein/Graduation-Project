<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Additem;
use App\User;
use App\Models\Covenant;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class ProfileController extends Controller
{
    public function profile($id){
        $user = User::find($id);
        if(!$user){
            $user = Auth::user();
        }
        $additems = Additem::where('user_id','=',$user->id)->orderBy('date','DESC')->paginate($perPage = 12, $columns = ['*'], $pageName = 'items');
        $covenant = Covenant::where('user_id','=',$user->id)->orderBy('date','DESC')->paginate($perPage = 12, $columns = ['*'], $pageName = 'cove');
        $arr = array(
            'title'=>'الملف الشخصي',
            'user'=>$user,
            'data'=>$additems,
            'covenants'=>$covenant,
        );

        return view('profile',$arr);
    }

    public function employee($id){
        $user = Employee::find($id);
        if(!$user){
            return redirect('covenant-owner');
        }
        $covenant = Covenant::where('employee_id','=',$user->id)->orderBy('date','DESC')->paginate($perPage = 12, $columns = ['*'], $pageName = 'cove');
        $arr = array(
            'title'=>'الملف الشخصي',
            'user'=>$user,
            'covenants'=>$covenant,
        );

        return view('employees',$arr);
    }


}
