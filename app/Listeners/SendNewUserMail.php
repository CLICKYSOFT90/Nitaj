<?php

namespace App\Listeners;

use App\Events\NewUserMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendNewUserMail
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
     * @param  \App\Events\NewUserMail  $event
     * @return void
     */
    public function handle(NewUserMail $event)
    {
        $user = User::find($event->userId)->toArray();
        Mail::send('mail.AdminNewUser', $user, function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Event Testing');
        });
    }
}
