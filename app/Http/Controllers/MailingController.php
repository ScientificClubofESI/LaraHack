<?php

namespace App\Http\Controllers;

use App\Hacker;
use App\Mail\Accepted;
use App\Mail\Rejected;
use App\Mail\Waiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MailingController extends Controller
{
    public function sendEmailsAccepted(){
        $acceptedHackers = DB::table('hackers')
            ->where('decision','=','accepted')
            ->select('id as id','email as email','first_name as name')
            ->get();

        $token = '';

        foreach ($acceptedHackers as $hacker){
            $token = Hash::make($hacker->id.$hacker->name);
            $link = route('confirm',['token'=>$token]);
            Mail::to($hacker)->send(new Accepted($link));
        }
    }


    public function sendEmailsRejected(){
        $rejectedHackers = DB::table('hackers')
            ->where('decision','=','rejected')
            ->select('email as email','first_name as name')
            ->get();

        Mail::bcc($rejectedHackers)->send(new Rejected());
    }

    public function sendEmailsWaiting(){
        $waitingHackers = DB::table('hackers')
            ->where('decision','=','waiting_list')
            ->select('email as email','first_name as name')
            ->get();

        Mail::bcc($waitingHackers)->send(new Waiting());
    }
}
