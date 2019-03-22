<?php

namespace App\Http\Controllers;

use App\Hacker;
use App\Http\Requests\SetDecisionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display all hackers , regardless if they have a team or not
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $hackers = DB::table('hackers')
            ->join('teams', 'hackers.team_id', '=', 'teams.id')
            ->select('hackers.id as id', 'hackers.first_name as first_name',
                'hackers.last_name as last_name', 'hackers.email as email', 'hackers.sex as sex',
                'hackers.birthday as birthday', 'hackers.phone_number as phone_number',
                'hackers.motivation as motivation', 'hackers.github as github', 'hackers.linked_in as linked_in',
                'hackers.skills as skills', 'hackers.size as size', 'hackers.decision as decision', 'teams.name as team_name')
            ->orderBy('team_name')
            ->get(); // Getting all hackers with team and their teams name
        $hackersNoTeam = DB::table('hackers')->whereNull('team_id')->get(); // Getting all hackers without a team
        $hackers = $hackers->merge($hackersNoTeam); // Putting all in one table
        return view('dashboard', ['hackers' => $hackers]);
    }

    public function dashboard2()
    {
        return view('dashboard-argon');
    }
    /**
     * @param Request $request
     * Setting the decision for a hacker , it can be either accepter , rejected or to the waiting list
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDecision(SetDecisionRequest $request)
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

    public function statistics(){
        return view('statistics');
    }


}
