<?php

namespace App\Http\Controllers;

use App\Hacker;
use App\Mail\RegistrationDone;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HackerController extends Controller
{
    /**
     * Display all hackers , regardless if they have a team or not
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hackers = DB::table('hackers')
            ->join('teams', 'hackers.team_id', '=', 'teams.id')
            ->select('hackers.id as id', 'hackers.first_name as first_name', 'hackers.last_name as last_name',
                'hackers.email as email', 'hackers.sex as sex', 'hackers.birthday as birthday', 'hackers.phone_number as phone_number',
                'hackers.motivation as motivation', 'hackers.github as github', 'hackers.linked_in as linked_in',
                'hackers.skills as skills', 'hackers.size as size', 'hackers.decision as decision', 'teams.name as team_name')
            ->orderBy('team_name')
            ->get(); // Getting all hackers with team and their teams name
        $hackersNoTeam = DB::table('hackers')->whereNull('team_id')->get(); // Getting all hackers without a team
        $hackers = $hackers->merge($hackersNoTeam); // Putting all in one table
        return view('home', ['hackers' => $hackers]);
    }

    /**
     * Show the registration page
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store the hacker
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
                return response()->json(['success' => 'Inscription done', 'code' => $team->code, 'name' => $team->name]);

            }

            elseif ($request->request->get('team_id') != '') {//If the request contains a team's id , so the hacker want to join a team

                $team_id = $request->request->get('team_id');
                $team = Team::find($team_id);
                $team->hackers()->save($hacker);
                return response()->json(['success' => 'Inscription done', 'code' => $team->code, 'name' => $team->name]);

            }

            else {// Else, the hacker have no team

                $hacker->save();
                return response()->json(['success' => 'Inscription done']);
            }

        }

        catch (\Exception $exception) {

            return response()->json(['success' => 'Try again :/ !' . $exception->getMessage()]);// For debug only , You should remove the get message before production
        }

    }

    /**
     * @param Request $request
     * Check if the code is correct , returning the id and the name if correct
     * @return false|string
     */
    public function checkCode(Request $request)
    {
        $code = $request->request->get('teamCode');
        $team = DB::table('teams')->where('code', '=', $code)->first();
        if ($team != null) return json_encode(['id' => $team->id, 'team_name' => $team->name]);
        else return json_encode(['error' => 'your code is not valid']);
    }

    /**
     * @param Request $request
     * Setting the decision for a hacker , it can be either accepter , rejected or to the waiting list
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDecision(Request $request)
    {
        $hacker_id = $request->request->get('id');
        $hacker = Hacker::find($hacker_id);
        $decision = $request->request->get('decision');
        $hacker->decision = $decision;
        $result = $hacker->save();
        return response()->json([
            'response' => $result,
        ]);

    }
    
}
