<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\SendMailToUser;
use App\Mail\CreateUserEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
            Mail::to($event->user->email)->queue(new CreateUserEmail($event->user, $event->password));
    }
}
