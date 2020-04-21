<?php

namespace App\Listeners;

use App\Events\NewCustHasRegEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegCustToNewsLeter
{

    public function handle(NewCustHasRegEvent $event)
    {
        dump('reg to newsletter');
    }
}
