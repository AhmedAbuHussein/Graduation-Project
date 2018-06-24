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
        $coven = Covenant::count('id');


        $arr = Array(
            'title' =>'الرئيسيه',
            'adds'=>$adds,
            'datastore'=>count($datastore),
            'users'=>$users,
            'stores'=>$stores,
            'cov'=>$coven,
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
            $user = Auth::user();
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
           $img = $req->id."_". time() . ".".$req->imgfile->getClientOriginalExtension();
        }
        $item = User::find($req->id);
        if(isset($item->img)){
            $image = $item->img; // old image name;
        }
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
            
            if(isset($image)&& !is_null($image) && isset($img)){
                unlink(public_path('uploaded/') . $image);
            }
            if(isset($img)){
                $req->imgfile->move(public_path('/uploaded'),$img);
            }
            return redirect('/users');
        }else{
            return redirect($_SERVER['HTTP_REFERER'].'#not-save');
        }
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
        $hash = '';
        $this->validate($req,[
            'source'=>'required',
            'price'=>'required',
            'quantity'=>'required',
        ]);

        if(Auth::user()->store_id == $req->store_id && Auth::user()->role == 1){ // store owner
            $item = Additem::find($req->itemid);
            $oldquantity = filter_var($item->quantity,FILTER_SANITIZE_STRING); // quantity of last addition
            if($oldquantity > $req->quantity){ // new quantity lower than last addition
                $total = $req->total - $oldquantity + $req->quantity;
                if($total < 0){ 
                    return redirect($_SERVER['HTTP_REFERER']);
                }
            }
            $item->source = filter_var($req->source,FILTER_SANITIZE_STRING);
            $item->price = filter_var($req->price,FILTER_SANITIZE_STRING);
            $item->quantity = filter_var($req->quantity,FILTER_SANITIZE_STRING);
            if($item->save()){
                $hash = "#edit-save-owner";
            }else{
                $hash = "#edit-not-save";
            }
            $this->updateQuentity($item->datastore_id);
        }else{ // store writer or super admin
            $newItem = new Edititem();
            $newItem->source = filter_var($req->source,FILTER_SANITIZE_STRING);
            $newItem->permision = filter_var($req->permision,FILTER_SANITIZE_STRING);
            $newItem->quantity = filter_var($req->quantity,FILTER_SANITIZE_STRING);
            $newItem->price = filter_var($req->price,FILTER_SANITIZE_STRING);
            $newItem->store_id = filter_var($req->store_id,FILTER_SANITIZE_STRING);
            $newItem->additem_id = filter_var($req->itemid,FILTER_SANITIZE_STRING);
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
                $hash = "#edit-save";
            }else{
                $hash = "#edit-not-save";
            }
            
        }
        return redirect($_SERVER['HTTP_REFERER'] . $hash);
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
            if(!$new->save()){
                return redirect($_SERVER['HTTP_REFERER'] . '#error');
            } 
            $this->updateQuentity($chk[0]->id);
        }else{
           $newdata = new Datastore();
           $newdata->name = $product;
           $newdata->quantity = $quantity;
           $newdata->store_id = $store_id;
           if(!$newdata->save()){
            return redirect($_SERVER['HTTP_REFERER'] . '#error');
           }
           $datastore = Datastore::where('name','=',$product)
                                ->where('store_id','=',$store_id)
                                ->where('quantity','=',$quantity)
                                ->orderBy('id','DESC')->limit(1)->get();

            $new->datastore_id = $datastore[0]->id;
            if(!$new->save()){
                return redirect($_SERVER['HTTP_REFERER'] . '#error');
            } 

        }
        return redirect('/store');
    }

    public function updateQuentity($id){
        $data = Datastore::find($id);
        $data->quantity = Additem::where('datastore_id','=',$data->id)->sum('quantity') - Covenant::where('datastore_id','=',$data->id)->sum('quantity');
        $data->save();
    }

    //for update covenant for stores owners
    public function quentity(){
        $flag = true;
        $data = Covenant::all();
        foreach($data as $d){
            if($d->datastore->store->id == 3){
                if($flag){
                    $d->user_id = 6;
                    $flag = false;
                }else{
                    $d->user_id = 7;
                    $flag = true;
                }
            }
            $d->save();
        }
        

      
    }

    
}
