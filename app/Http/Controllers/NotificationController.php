<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Edititem;
use App\Models\Additem;
use App\Models\Datastore;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;
use App\Notifications\DatabaseNotification;

class NotificationController extends Controller
{

    public function get(Request $req){
        if(Auth::user()->role !== 0){
            return [Auth::user()->unreadNotifications,Auth::user()->store->name];
        }else{
            return [Auth::user()->unreadNotifications,''];
        }
    }

    public function writeredit(Request $req){

        $edititem = Edititem::find($req->get('item'));
        $additem = Additem::find($edititem->additem_id);

        $arr = array(
            'title'=> 'حفظ التعديل',
            'edititem'=>$edititem,
            'additem'=> $additem,
            'notify'=>$req->get('notify'),
        );
        return view('saveEdit',$arr);
    }

    public function cancalEdit(Request $req){
        $notid = $req->get('notify');
        $this->markAsReaded($notid);
        return redirect('/store');
    }

    public function saveEdit(Request $req){
        $notid = $req->get('notify');
        $this->markAsReaded($notid);

        $edititemid = $req->get('id');
        $edititem = Edititem::find($edititemid);
        $additem = Additem::where('permision','=',$edititem->permision)->get();
        $additem = $additem[0];
        $additem->source = $edititem->source;
        $additem->price = $edititem->price;
        $additem->quantity = $edititem->quantity;
        if($additem->save()){
            $this->modifyQuantity($additem->datastore_id);

            $user = User::where('role','=',2)->where('store_id','=',$edititem->store_id)->get();
            User::find($user[0]->id)->notify(new DatabaseNotification($edititem));

            $notify = Notification::where('notifiable_id','=',$user[0]->id)->orderBy('created_at','DESC')->limit(1)->get();
            $data=[
                'msg'=>"تم حفظ التغير الذي قمت به من قبل امين المخزن",
                'notify'=>$notify
            ];

            @StreamLabFacades::pushMessage('FCINotification','DatabaseNotification',$data);

            return redirect('/store');
        }
    }



    public function modifyQuantity($id){
        $datastore = Datastore::find($id);
        $items = Additem::where('datastore_id','=',$id)->sum('quantity');
        $datastore->quantity = $items;
        $datastore->save();
    }


    public function markAsReaded($notify){
        $notification = Auth::user()->unreadNotifications;
        foreach ($notification as  $not) {
            if($not->id == $notify){
                $not->markAsRead();
                break;
            }
        }
    }

}