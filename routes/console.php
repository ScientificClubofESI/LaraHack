<?php

use App\Http\Controllers\MailingController;
use App\Mail\Accepted;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('mailAccepted',function (){
    $controller=new MailingController();
    $controller->sendEmailsAccepted();
});

Artisan::command('mailRejected',function (){
    $controller=new MailingController();
    $controller->sendEmailsRejected();
});

Artisan::command('mailWaiting',function (){
    $controller=new MailingController();
    $controller->sendEmailsWaiting();
});
