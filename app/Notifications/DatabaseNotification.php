<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Edititem;
use Illuminate\Support\Facades\Auth;

class DatabaseNotification extends Notification
{
    use Queueable;
    public $edititem ;
    
    public function __construct(Edititem $edititem)
    {
        $this->edititem = $edititem;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            "store"=>$this->edititem->store_id,
            'itemid'=>$this->edititem->id,
            'permision'=>$this->edititem->permision,
            
        ];
    }
}
