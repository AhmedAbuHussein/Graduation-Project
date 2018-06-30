<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Covenant;

class EmployeeController extends Controller
{
    public function index(){
        
        $arr = array(
            'title'=>'اصحاب عهد',
        );
        return view('employee',$arr);
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

    public function show(Request $req){
        $ssn = $req->ssn;
        $emp = Employee::where('ssn','=',$ssn)->get();
        if(count($emp) > 0){
            return redirect('/employee/'.$emp[0]->id);
        }else{
            return redirect('/#not-found');
        }
    }

    public function covenantowner(Request $req,$id){
        $owner= Employee::find($id);
        $arr = array(
            'title'=> 'تفاصيل العهده',
            'owner'=> $owner,
        );
        return view('covenantDetails',$arr);
    }

    public function covenantsData(Request $req){
        $data = Covenant::where('covenants.employee_id','=',$req->get('userid'))
                            ->join('datastores','datastores.id','=','covenants.datastore_id')
                            ->join('stores','datastores.store_id','=','stores.id')
                            ->join('users','users.id','=','covenants.user_id')
                            ->select('stores.name As store','covenants.quantity','covenants.id','datastores.name As datastorename','users.fullname As username')
                            ->get();
      

            return json_encode($data);
    }

    public function errorRoute(){
        $arr = array(
            'title' => '404 not found',
        );
        return view('error.error',$arr);
    }
}
