<?php

namespace App\Http\Controllers;

use App\Hacker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ConfirmationsController extends Controller
{
    function confirmHacker(Request $request)
    {
        $decrypted = Crypt::decrypt($request->token);
        preg_match_all('!\d+!', $decrypted, $id);
        $id=$id[0][0];
        $hacker = Hacker::find( (int) $id);

        if ($hacker != null){
            $hacker->confirmAttendance();
            $hacker->save();
            $result = true;
        }
        else{
            $result = false;
        }
        return view('confirmation',['result'=>$result]);
    }
}
