<?php

namespace App\Http\Controllers\Hacker;

use App\Team;
use App\Hacker;
use Carbon\Carbon;
use App\Mail\Registred;
use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\RegistrationRequest;

class RegisterController extends Controller
{
    /**
     * Show the registration page
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Valuestore::make(storage_path('app/settings.json'));
        if ($settings->get('registration_mode') == 'open') {
            return view('registration.register');
        } else {
            return view('registration.closed');
        }
    }

    /**
     * Store the hacker
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationRequest $request)
    {
        try {
            $hacker = new Hacker();
            $hacker->first_name = $request->request->get('first_name');
            $hacker->last_name = $request->request->get('last_name');
            $hacker->email = $request->request->get('email');
            $hacker->sex = $request->request->get('sex');
            $hacker->birthday = $request->request->get('birthday');
            $hacker->phone_number = $request->request->get('phone');
            $hacker->motivation = $request->request->get('motivation');
            $hacker->github = $request->request->get('github');
            $hacker->linked_in = $request->request->get('linked_in');
            $hacker->skills = $request->request->get('skills');
            $hacker->size = $request->request->get('size');

            if ($request->request->get('team_name') != '') { //If the request contains a team's name , so the hacker want to create a team

                $team = new Team();
                $team->name = $request->request->get('team_name');
                $team->code = str_random();
                $team->save();
                $team->hackers()->save($hacker);
                Mail::to($hacker)->send(new Registred($hacker,$team->name,$team->code));
                return response()->json(['success' => 'Registration done', 'code' => $team->code, 'name' => $team->name]);

            }

            elseif ($request->request->get('team_id') != '') {//If the request contains a team's id , so the hacker want to join a team

                $team_id = $request->request->get('team_id');
                $team = Team::find($team_id);
                $team->hackers()->save($hacker);
                Mail::to($hacker)->send(new Registred($hacker,$team->name,$team->code));
                return response()->json(['success' => 'Registration done', 'code' => $team->code, 'name' => $team->name]);

            }

            else {// Else, the hacker have no team
                $hacker->save();
                Mail::to($hacker)->send(new Registred($hacker));
                return response()->json(['success' => 'Registration done' , 'created' => true ] ,201);
            }

        }

        catch (\Exception $exception) {

            return response()->json(['success' => 'Try again :/ !' . $exception->getMessage()]);// For debug only , You should remove the get message before production
        }

    }

    function update(Request $request)
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
