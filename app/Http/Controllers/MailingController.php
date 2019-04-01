<?php

namespace App\Http\Controllers;

use App\Hacker;
use App\Jobs\SendAcceptedEmails;
use App\Jobs\SendRejectedEmails;
use App\Jobs\SendWaitingEmails;
use App\Mail\Accepted;
use App\Mail\Rejected;
use App\Mail\Waiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class MailingController extends Controller
{
    public function sendEmailsAccepted(){
        $acceptedHackers = DB::table('hackers')
            ->where('decision','=','accepted')
            ->whereNull('accepted_email_received_at')
            ->select('id as id','email as email','first_name as name')
            ->get();

        $token = '';

        foreach ($acceptedHackers as $hacker){
            $myDate = (string) Carbon::now();
            $hacker->accepted_email_received_at = $myDate ;
            $hacker->save();
            $token = Crypt::encrypt($hacker->id.$hacker->name);
            $link = route('confirm',['token'=>$token]);
            $this->dispatch(new SendAcceptedEmails($hacker,$link));
        }

    }


    public function sendEmailsRejected(){
        $rejectedHackers = DB::table('hackers')
            ->where('decision','=','rejected')
            ->select('email as email','first_name as name')
            ->get();

        foreach ($rejectedHackers as $hacker){
            $this->dispatch(new SendRejectedEmails($hacker));
        }
    }

    public function sendEmailsWaiting(){
        $waitingHackers = DB::table('hackers')
            ->where('decision','=','waiting_list')
            ->select('email as email','first_name as name')
            ->get();

        foreach ($waitingHackers as $hacker){
            $this->dispatch(new SendWaitingEmails($hacker));
        }
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
