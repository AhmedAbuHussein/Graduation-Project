<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Store;
use App\Models\Datastore;
use Illuminate\Support\Facades\Auth;
use App\Models\Additem;
use App\Userhistorie;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
       $adds = Additem::orderBy('id','DESC')->limit(5)->get();
       $datastore = Datastore::all();
       $users = User::all();
       $stores = Store::all();
        $arr = Array(
            'title' =>'الرئيسيه',
            'adds'=>$adds,
            'datastore'=>count($datastore),
            'users'=>count($users),
            'stores'=>$stores,
        ) ;
        return view('dashboard',$arr);
    }

    public function users(){
        $users = User::all();
        $arr = Array(
            'title'=>'المستخدمين',
            'users'=>$users,
        );
        return view('users',$arr);
    }

    public function store(){
       
        $arr = array(
            'title'=>'المخازن',
        );

        return view('store',$arr);
    }

    public function covenant(){
        echo "Covenant";
    }
    public function modifyuser(Request $req){
        $stors = Store::all();
        if(Auth::user()->role == 0){
            $user = User::find($req->get('id'));
        }else{
            $user = User::find(Auth::id());
        }

        $arr = array(
            'title'=>'تعديل',
            'stores'=>$stors,
            'user'=>$user,
        );
        return view('edituser',$arr);
    }


    public function profile(Request $req){
        $user = User::find($req->get('id'));
        $arr = array(
            'title'=>'الملف الشخصي',
            'user'=>$user,
        );

        return view('profile',$arr);
    }

    public function editDatastore(Request $req){
        $item = Additem::find($req->get('id'));
        $arr = array(
            'title'=>'تعديل',
            'item'=>$item,
        );
        return view('editstore',$arr);
    }

    public function details(Request $req,$id){
       
        $arr = array(
            'title'=>'تفاصيل',
            'itemid'=>$id,
        );
        return view('itemDetails',$arr);
    }

    public function additem(){
        $stores = Store::all();
        $arr=array(
            'title'=>'توريد جديد',
            'stores'=> $stores,
        );
        return view('additem',$arr);

    }

    public function insertitem(Request $req){
        $userid = Auth::id();

        $this->validate($req,[
            'product'=>'required',
            'source'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'permision'=>'required',
            'store_id'=>'required'
        ]);

        $product = filter_var($req->product,FILTER_SANITIZE_STRING);
        $source = filter_var($req->source,FILTER_SANITIZE_STRING);
        $quantity = filter_var($req->quantity,FILTER_SANITIZE_NUMBER_INT);
        $price = filter_var($req->price,FILTER_SANITIZE_NUMBER_FLOAT);
        $permision = filter_var($req->permision,FILTER_SANITIZE_STRING);
        $store_id = filter_var($req->store_id,FILTER_SANITIZE_NUMBER_INT);

        $chk = Datastore::where('name','=',$product)->where('store_id','=',$store_id)->limit(1)->get();

        $new = new Additem();
        $new->source = $source;
        $new->quantity = $quantity;
        $new->price = $price;
        $new->permision = $permision;
        $new->user_id = Auth::id();

        if(count($chk)>0){

            $new->datastore_id = $chk[0]->id;
            $new->save(); 

            $count = Additem::where('datastore_id','=',$chk[0]->id)->sum('quantity');
            $item = Datastore::find($chk[0]->id);
            $item->quantity = $count;
            $item->save();
        }else{
           $new = new Datastore();
           $new->name = $product;
           $new->quantity = $quantity;
           $new->store_id = $store_id;
           $new->save();
           $datastore = Datastore::where('name','=',$product)
                                ->where('store_id','=',$store_id)
                                ->where('quantity','=',$quantity)
                                ->orderBy('id','DESC')->limit(1)->get();

            $item->datastore_id = $datastore[0]->id;
            $item->save();

        }

        $itemid = Additem::where('permision','=',$permision)
                            ->where('user_id','=',Auth::id())
                            ->where('source','=',$source)
                            ->orderby('id','DESC')
                            ->limit(1)->get();
        $date = new Userhistorie();
        $date->user_id = Auth::id();
        $date->additem_id = $itemid[0]->id;
        $date->date = now();
        $date->save();

    }
}
