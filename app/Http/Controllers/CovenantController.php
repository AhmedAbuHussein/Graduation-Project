<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Datastore;
use Illuminate\Support\Facades\Auth;
use App\Models\Covenant;
use App\Models\Additem;

class CovenantController extends Controller
{
    public function makeCovenant(){
        $auth = Auth::user()->store_id;
        $emp = Employee::orderBy('name','DESC')->get();
        $items = Datastore::where('store_id','=',$auth)->orderBy('name','ASC')->get();
        $arr = array(
            'title'=>'صرف',
            'emps'=>$emp,
            'datastores'=>$items
        );
        return view('covenants.makeCov',$arr);
    }

    public function checkquantity(Request $req){
        $item = $req->get('id');
        $quantity = Datastore::find($item);

        return $quantity->quantity;
    }

    public function checkpermision(Request $req){
        $per = $req->get('per');
        $chk = Covenant::where('permision','=',$per)->get();
        if(count($chk) > 0){
            return 'error';
        }
        return 'ok';
    }

    public function insertEmp(Request $req){
        $this->validate($req,[
            'name'=>'required',
            'ssn'=>'required|min:14|max:14',
            'phone'=>'required|min:10|max:11',
            'email'=>'required',
            'establishment'=>'required|min:5'
        ]);
        $name = filter_var($req->name,FILTER_SANITIZE_STRING);
        $ssn = filter_var($req->ssn,FILTER_SANITIZE_STRING);
        $phone = filter_var($req->phone,FILTER_SANITIZE_STRING);
        $email = filter_var($req->email,FILTER_SANITIZE_STRING);
        $est = filter_var($req->establishment,FILTER_SANITIZE_STRING);

        $item = new Employee();
        $item->name = $name;
        $item->ssn = $ssn;
        $item->phone = $phone;
        $item->email = $email;
        $item->establishment = $est;
        $item->save();
        return redirect('/make-covenant#covenant');
         
    }

    public function insertCov(Request $req){

        $this->validate($req,[
            'datastore'=>'required',
            'quantity'=>'required',
            'permision'=>'required',
            'employee'=>'required'
        ]);
        $datastoreid = filter_var($req->datastore,FILTER_SANITIZE_NUMBER_INT);
        $quantity = filter_var($req->quantity,FILTER_SANITIZE_NUMBER_INT);
        $permision = filter_var($req->permision,FILTER_SANITIZE_STRING);
        $employeeid = filter_var($req->employee,FILTER_SANITIZE_NUMBER_INT); 
        $userid = Auth::id();
        $date = now();

        $item = new Covenant();
        $item->quantity = $quantity;
        $item->permision = $permision;
        $item->employee_id = $employeeid;
        $item->user_id = $userid;
        $item->datastore_id = $datastoreid;
        $item->date = $date;
        if($item->save()){
            $this->updateQuentity($datastoreid);
            return redirect('/covenant-owner');
        }
        return redirect('/dashboard');

    }

    public function detailscov(Request $req){
        $items = Covenant::join('users','users.id','=','covenants.user_id')
                        ->join('employees','employees.id','=','covenants.employee_id')
                        ->select('covenants.id','covenants.quantity','covenants.permision','users.fullname as username','users.id As userid','employees.name as employee', 'employees.id as empid')
                        ->where('covenants.datastore_id','=',$req->id)
                        ->get();

        $itemname = Datastore::find($req->id);
        return json_encode([$items,$itemname]);

    }

    public function updateQuentity($id){
        $data = Datastore::find($id);
        $data->quantity = Additem::where('datastore_id','=',$data->id)->sum('quantity') - Covenant::where('datastore_id','=',$data->id)->sum('quantity');
        $data->save();
    }

    public static function totalQuantity(){
        $datast = Datastore::all();
        foreach ($datast as $d) {
            $x = Additem::where('datastore_id','=',$d->id)->sum('quantity') - Covenant::where('datastore_id','=',$d->id)->sum('quantity');
            $d->quantity = $x;
            $d->save();
        }
    }

}
