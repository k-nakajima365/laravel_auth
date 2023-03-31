<?php

namespace App\Listeners;

use App\Events\Updated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\UpdatingVerificationNotification;

class SendUpdatingVerificationNotification
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
    public function handle(Updated $event): void
    {
        if (! $event->user->hasVerifiedEmail()) {
            $event->user->notify(new UpdatingVerificationNotification);
        }
    }
}
