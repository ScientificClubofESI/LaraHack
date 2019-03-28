<?php

namespace App\Http\Controllers;

use App\Hacker;
use App\Mail\Accepted;
use App\Mail\Rejected;
use App\Mail\Waiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailingController extends Controller
{
    public function sendEmailsAccepted(){
        $acceptedHackers = DB::table('hackers')
            ->where('decision','=','accepted')
            ->select('id as id','email as email','first_name as name')
            ->get();

        $token = '';

        foreach ($acceptedHackers as $hacker){
            $token = Crypt::encrypt($hacker->id.$hacker->name);
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
    
    public function mailHandler(Request $request)
    {
        $mailType = json_decode($request->getContent())->MailType;
        switch ($mailType) {
            case 'accepted_mail':
                $this->sendEmailsAccepted();
                break;
            case 'rejected_mail':
                $this->sendEmailsRejected();
                break;
            case 'waiting_mail':
                $this->sendEmailsWaiting();
                break;
            
            default:
                
                break;
        }
        return response()->json([
            'response' => '200',
        ]);
    }
}
