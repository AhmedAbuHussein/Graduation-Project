<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DatabaseNotification extends Notification
{
    use Queueable;
    protected $post;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        return [
            "row_id"=>$post->row_id,
            "message"=>$post->message,
            "store_id"->$post->store_id,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
