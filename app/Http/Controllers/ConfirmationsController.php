<?php

namespace App\Http\Controllers;

use App\Hacker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class ConfirmationsController extends Controller
{
    /**
     * @param Request $request
     * Confirm an accepted hacker when he click the link
     * If the link is expired then the hacker is rejected
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function confirmHacker(Request $request)
    {
        $decrypted = Crypt::decrypt($request->token);
        preg_match_all('!\d+!', $decrypted, $id);
        $id=$id[0][0];
        $hacker = Hacker::find( (int) $id);
        $now = Carbon::now();
        $limit = 2 ;
        $recieved_date = Carbon::parse($hacker->accepted_email_received_at)->addDays($limit) ; 
        if ($hacker != null){
            if($recieved_date->lt($now)) {
                $hacker->reject();
                $hacker->save();
                return view('registration.expire');
            } else {
                $hacker->confirmAttendance();
                $hacker->save();
                $result = true;
            }
        }
        else{
            $result = false;
        }
            return view('registration.confirmation',['result'=>$result]);
    }
}
