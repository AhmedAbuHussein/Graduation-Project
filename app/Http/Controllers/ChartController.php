<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function chart()
    {
        $arr = Array(
            'title'=>'الاحصائيات',
            
        );
        return view('chart',$arr);
    }
}
