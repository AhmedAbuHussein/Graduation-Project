<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        
        $arr = array(
            'title'=>'اصحاب عهد',
        );
        return view('employee',$arr);
    }
}
