<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function index(){
        $arr = array(
            'title'=>'PDF',
        );
        return view('pdf',$arr);
    }
}
