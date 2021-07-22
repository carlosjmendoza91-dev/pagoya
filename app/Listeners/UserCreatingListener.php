<?php


namespace App\Listeners;

use App\Events\UserCreatingEvent as UserCreatingEvent;

class UserCreatingListener
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
     * @param  UserCreatingEvent  $event
     * @return void
     */
    public function handle(UserCreatingEvent $event)
    {
        //
    }
}
