<?php

namespace App\Http\Controllers\Admin;

use App\Hacker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\SendWaitingEmails;
use App\Jobs\SendAcceptedEmails;
use App\Jobs\SendRejectedEmails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MailingController extends Controller
{

    /**
     * Mailing view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $hackers = Hacker::all()->where('decision','=','not_yet');
        $number_of_not_viewed_hackers = count($hackers);

        $hackers = Hacker::all()->where('decision','=','accepted');
        $number_of_accepted_hackers = count($hackers);

        $hackers = Hacker::all()->where('decision','=','rejected');
        $number_of_rejected_hackers = count($hackers);

        $hackers = Hacker::all()->where('decision','=','waiting_list');
        $number_of_waiting_hackers = count($hackers);

        return view('dashboard.mailing' , ['accepted' => $number_of_accepted_hackers , 'rejected' => $number_of_rejected_hackers , 'waiting' => $number_of_waiting_hackers , 'not_yet' => $number_of_not_viewed_hackers]);
    }

    /**
     * @param Request $request
     * Handle the request sent from mail view and send the appropriate emails category
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
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

    /**
     *Send emails to all accepted hackers that haven't received an accepted email yet
     */
    protected function sendEmailsAccepted()
    {
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
    protected function sendEmailsRejected()
    {
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
    protected function sendEmailsWaiting()
    {
        $waitingHackers = DB::table('hackers')
            ->where('decision','=','waiting_list')
            ->select('email as email','first_name as name')
            ->get();

        foreach ($waitingHackers as $hacker){
            $this->dispatch(new SendWaitingEmails($hacker));
        }
    }
}
