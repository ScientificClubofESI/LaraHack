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
    /**
     *Send emails to all accepted hackers that haven't received an accepted email yet
     */
    public function sendEmailsAccepted(){
        $acceptedHackers = Hacker::all()
            ->where('decision','=','accepted')
            ->where('accepted_email_received_at' , '=' , null);

        $token = '';

        foreach ($acceptedHackers as $hacker){
            $hacker->accepted_email_received_at = Carbon::now() ;
            $hacker->save();
            $token = Crypt::encrypt($hacker->id.$hacker->first_name);
            $link = route('confirm',['token'=>$token]);
            $this->dispatch(new SendAcceptedEmails($hacker,$link));


            /** if you have a problem with laravel queues , just use this way to send emails :
             *
             *  Mail::to($hacker)->send(new Accepted($link,$hacker));
             *
             */
        }

    }


    /**
     *Send email to all rejected hackers
     */
    public function sendEmailsRejected(){
        $rejectedHackers = DB::table('hackers')
            ->where('decision','=','rejected')
            ->select('email as email','first_name as name')
            ->get();

        foreach ($rejectedHackers as $hacker){
            $this->dispatch(new SendRejectedEmails($hacker));
        }
    }

    /**
     *Send email to all wainting list hackers
     */
    public function sendEmailsWaiting(){
        $waitingHackers = DB::table('hackers')
            ->where('decision','=','waiting_list')
            ->select('email as email','first_name as name')
            ->get();

        foreach ($waitingHackers as $hacker){
            $this->dispatch(new SendWaitingEmails($hacker));
        }
    }

    /**
     * @param Request $request
     * Handle the request sent from mail view and send the appropriate emails category
     * @return \Illuminate\Http\JsonResponse
     */
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
