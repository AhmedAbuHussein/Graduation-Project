<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Additem;
use Illuminate\Support\Facades\Auth;
use App\Models\Covenant;
use App\Models\Datastore;
use App\Models\Employee;

class PDFController extends Controller
{

    public function index(){
        $all = Additem::join('datastores','datastores.id','=','additems.datastore_id')
                        ->where('datastores.store_id','=',Auth::user()->store_id)
                        ->sum('additems.quantity');

        $cov = Covenant::join('datastores','datastores.id','=','covenants.datastore_id')
                        ->where('datastores.store_id','=',Auth::user()->store_id)
                        ->sum('covenants.quantity');
        
        $stay = Datastore::where('store_id','=',Auth::user()->store_id)->sum('quantity');

        $emp = Covenant::join('datastores','datastores.id','=','covenants.datastore_id')
                        ->join('employees','employees.id','=','Covenants.employee_id')
                        ->where('datastores.store_id','=',Auth::user()->store_id)
                        ->select('employees.*','covenants.quantity','datastores.name As dname')
                        ->orderBy('employees.id','ASC')->get();

        $data = [
            'all'=>$all,
            'cov'=>$cov,
            'stay'=>$stay,
            'emps'=>$emp,
        ];
        //  return view('pdf',$data);
        $pdf = PDF::loadView('pdf', $data);
        return $pdf->stream('report.pdf');
    }
}
