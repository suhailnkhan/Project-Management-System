<?php

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeNewCustomerListener implements ShouldQueue
{

    public function __construct()
    {

    }

    public function handle($event)
    {
        sleep(10);
        Mail::to($event->user-> email)->send(new WelcomeMail());

    }
}
