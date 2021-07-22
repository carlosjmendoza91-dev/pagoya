<?php


namespace App\Listeners;

use App\Events\UserSavingEvent as UserSavingEvent;

class UserSavingListener
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
     * @param  UserSavingEvent  $event
     * @return void
     */
    public function handle(UserSavingEvent $event)
    {
        //
    }
}
