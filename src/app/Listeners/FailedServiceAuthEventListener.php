<?php

namespace App\Listeners;

use App\Events\FailedServiceAuthEvent;

class FailedServiceAuthEventListener
{
    public function __construct()
    {
        //
    }

    public function handle(FailedServiceAuthEvent $event)
    {
        $event->log();
    }
}
