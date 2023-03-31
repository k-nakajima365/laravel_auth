<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Notifications\RegisteringVerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRegisteringVerificationNotification
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
    public function handle(Registered $event): void
    {
        if (! $event->user->hasVerifiedEmail()) {
            $event->user->notify(new RegisteringVerificationNotification);
        }
    }
}
