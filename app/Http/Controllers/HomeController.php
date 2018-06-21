<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Store;
use App\Models\Datastore;
use Illuminate\Support\Facades\Auth;
use App\Models\Additem;
use App\Notifications\DatabaseNotification;
use App\Models\Covenant;
use App\Models\Edititem;
use App\Models\Notification;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;

class HomeController extends Controller
{
    
    public function __construct(){
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

    public function modifyusersave(Request $req){
        $this->validate($req,[
            'fullname'=>'required',
            'username'=>'required',
            'email'=>'required',
            'role'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);

        $fullname = filter_var($req->fullname,FILTER_SANITIZE_STRING);
        $username = filter_var($req->username,FILTER_SANITIZE_STRING);
        $email = filter_var($req->email,FILTER_SANITIZE_EMAIL);
        $phone = filter_var($req->phone,FILTER_SANITIZE_NUMBER_INT);
        $address = filter_var($req->address,FILTER_SANITIZE_STRING);
        if(isset($req->password)){
            $password = filter_var($req->password,FILTER_SANITIZE_STRING);
        }
        if($req->hasFile('imgfile')){
           $img = Auth::id()."_". time() . ".".$req->imgfile->getClientOriginalExtension();
        }
        $item = User::find($req->id);
        $image = $item->img;
        $item->fullname = $fullname;
        $item->username = $username;
        $item->email = $email;
        $item->phone = $phone;
        $item->address = $address;
        if(isset($password)){
            $item->password = Hash::make($password);
        }
        if(isset($img)){
            $item->img = $img;
        }
        $item->job_name = $req->role;
        if($req->role == 'مدير'){
            $item->role = 0;
        }elseif($req->role == 'امين مخزن'){
            $item->role = 1;
        }else{
            $item->role = 2;
        }
        $item->store_id = $req->store_id;
        if($item->save()){

            if(!is_null($image)){
                unlink(public_path('uploaded/') . $image);
            }
            $req->imgfile->move(public_path('/uploaded'),$img);
        }
        return redirect('/users');
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
        $datastoreid = $req->get('id');
        if(Auth::user()->store_id != Datastore::find($datastoreid)->store->id){
            return redirect('/store');
        }

        $item = Additem::where('datastore_id','=',$datastoreid)->orderBy('id','DESC')->limit(1)->get();
        $cov = Covenant::where('datastore_id','=',$item[0]->datastore_id)->sum('quantity');
        $arr = array(
            'title'=>'تعديل',
            'item'=>$item[0],
            'cov'=>$cov,
        );
        return view('editstore',$arr);
    }

    public function editDatastoresave(Request $req){
        
        //TODO:: validate to re request
        if(Auth::user()->store_id == $req->store_id && Auth::user()->role == 1){
            $item = Additem::find($req->itemid);
            $oldquantity = $item->quantity;
            if($oldquantity > $req->quantity){
                $total = $req->total - $oldquantity + $req->quantity;
                if($total < $req->cov){
                    return redirect($_SERVER['HTTP_REFERER']);
                }
            }

            $item->source = $req->source;
            $item->price = $req->price;
            $item->quantity = $req->quantity;
            $item->save();
            $this->updateQuentity($item->datastore_id);
        }else{
            //TODO::notifiy her after save data into edititems
            $newItem = new Edititem();
            $newItem->source = $req->source;
            $newItem->permision = $req->permision;
            $newItem->quantity = $req->quantity;
            $newItem->price = $req->price;
            $newItem->store_id = $req->store_id;
            $newItem->additem_id = $req->itemid;
            $newItem->user_id = Auth::id();
            if($newItem->save()){
               
                $user = User::where('role','=',1)->where('store_id','=',$newItem->store_id)->get();
                User::find($user[0]->id)->notify(new DatabaseNotification($newItem));
                $notifyid = Notification::where('notifiable_id','=',$user[0]->id)->orderBy('created_at','DESC')->limit(1)->get();
                $data = [
                    "store"=>$newItem->store_id,
                    'itemid'=>$newItem->id,
                    'permision'=>$newItem->permision,
                    'user'=>$user[0]->id,
                    'notify'=>$notifyid[0]->id,    
                ];
                StreamLabFacades::pushMessage('FCINotification','DatabaseNotification',$data);
            }
            
        }
        return redirect('/store');
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
        $quantity = filter_var($req->quantity,FILTER_SANITIZE_STRING);
        $price = filter_var($req->price,FILTER_SANITIZE_STRING);
        $permision = filter_var($req->permision,FILTER_SANITIZE_STRING);
        $store_id = filter_var($req->store_id,FILTER_SANITIZE_NUMBER_INT);

        $chk = Datastore::where('name','=',$product)->where('store_id','=',$store_id)->limit(1)->get();

        $new = new Additem();
        $new->source = $source;
        $new->quantity = $quantity;
        $new->price = $price;
        $new->permision = $permision;
        $new->user_id = Auth::id();
        $new->date = now();

        if(count($chk)>0){

            $new->datastore_id = $chk[0]->id;
            $new->save(); 

            $this->updateQuentity($chk[0]->id);
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
        return redirect('/store');
    }

    public function updateQuentity($id){
        $data = Datastore::find($id);
        $data->quantity = Additem::where('datastore_id','=',$data->id)->sum('quantity') - Covenant::where('datastore_id','=',$data->id)->sum('quantity');
        $data->save();
        
    }


    public function quentity(){
        /*
        $data = Datastore::all();
        foreach($data as $d){
            $d->quantity = Additem::where('datastore_id','=',$d->id)->sum('quantity');
            $d->save();
        }
        */

      
    }

    
}
