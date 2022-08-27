<?php

namespace App\Listeners;

use App\Events\RescuerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RescuerCreated  $event
     * @return void
     */
    public function handle(RescuerCreated $event)
    {
        $fname = $event->rescuer_fname;
        $lname = $event->rescuer_lname;
        $email = $event->rescuer_email;
     
        Mail::send(
            'emails.Notification',
            ['first'=>$fname,
            'last'=>$lname],
            function($message) use($email,$fname,$lname) {
                $message->from('admin@test.com','Admin');
                $message->to($email,$fname,$lname);
                $message->subject('New animal has rescued !');
            }
        );
    }
}
