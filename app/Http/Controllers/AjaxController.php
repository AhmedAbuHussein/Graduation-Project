<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Datastore;
use App\Models\Store;
use App\User;
use App\Models\Additem;
use App\Models\Employee;
use App\Models\Covenant;

class AjaxController extends Controller
{

    public function stores(){
        if(Auth::user()->role == 0){
            $data = Datastore::join('stores','stores.id','=','datastores.store_id')
                                ->select('datastores.*','stores.name As storename')->get();
        }else{
            $data = Datastore::join('stores','stores.id','=','datastores.store_id')
                            ->select('datastores.*','stores.name As storename')
                            ->where("store_id","=",Auth::user()->store_id)->get();
        }

        $stores = Store::all(); 
        $arr = array(
            'data'=>$data,
            'stores'=>$stores,
        );

        return json_encode($arr);
    }

    public function users(){
        $users = User::join('stores','stores.id','=','users.store_id')
                        ->select('users.*','stores.name As storename')
                        ->get();
        $arr = array(
            'users'=>$users,
        );
        return json_encode($arr);
    }

    public function deleteuser($id){
        $user = User::find($id);
        $user->delete();
       return $this->users();
    }

    public function detailsItem(Request $req){
        $id = $req->get('id');

        $items = Additem::join('datastores','datastores.id','=','additems.datastore_id')
                        ->join('users','users.id','=','additems.user_id')
                        ->select('additems.*','datastores.name AS dataname','users.fullname AS username')
                        ->where('datastore_id','=',$id)
                        ->orderBy('id','DESC')
                        ->get();

        return json_encode($items);
    }

    public function mainChart(Request $req){
        $arr=array();
        $arr1 = array();
        $arr2 = array();
        for($i=1;$i<=count(Store::all());$i++){
            $item = Additem::join('datastores','datastores.id','=','additems.datastore_id')
                                ->where('datastores.store_id','=',$i)
                                ->sum('additems.quantity');
            array_push($arr1,$item);

            $item = Covenant::join('datastores','datastores.id','=','covenants.datastore_id')
                                ->where('datastores.store_id','=',$i)
                                ->sum('covenants.quantity');
            
            array_push($arr2,$item);

        }
        array_push($arr,$arr1,$arr2);
        
      
        return json_encode($arr);
    }

    public function itemsname(Request $req){
        $items = Datastore::select('name')->where('store_id','=',$req->id)->get();
        return json_encode($items);
    }

    public function chartAjax(Request $req){
        $count = array();
        $countadd = array();
        $countcov = array();
        $stores = \App\Models\Store::all();
        for($i=1;$i<=count($stores);$i++){
            array_push($countadd,Additem::join('datastores','datastores.id','=','additems.datastore_id')
                                        
                                        ->where('datastores.store_id','=',$i)
                                        ->where('additems.date','>=',$req->start)
                                        ->where('additems.date','<=',$req->end)
                                        ->sum('additems.quantity'));

            array_push($countcov,Covenant::join('datastores','datastores.id','=','covenants.datastore_id')
                                        ->where('datastores.store_id','=',$i)
                                        ->where('covenants.date','>=',$req->start)
                                        ->where('covenants.date','<=',$req->end)
                                        ->sum('covenants.quantity'));
        }
        array_push($count,$countadd,$countcov);
        return json_encode($count);
    }

    public function chartdoughnut(Request $req){
        $items = array();
        $stores = \App\Models\Store::all();
        for($i=1;$i<=count($stores);$i++){
            array_push($items,count(Datastore::where('store_id','=',$i)->get()));
        }
        return json_encode($items);
    }

    public function employees(Request $req){
        $emps = Employee::all();
        return json_encode($emps);
    }

    public function checkQuantity(Request $req){
        $item = Additem::find($req->get('itemid'));
        $oldquantity = $item->quantity;
        $total = $req->get('total') - $oldquantity + $req->get('quantity');
        $cov = $req->get('cov');
        if($total < $cov){
            return "error";
        }
        return "ok";
    }

}
