<?php

namespace App\Listeners;

use App\Events\NewCustHasRegEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminViaSlack
{

    public function __construct()
    {
        //
    }


    public function handle(NewCustHasRegEvent $event)
    {
        //

         dump('slack message');

    }
}
