<?php

namespace App\Http\Controllers\Admin;

use App\Hacker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetDecisionRequest;

class ManageUserController extends Controller
{
    public function index()
    {
         // Update Hackathon Decision " Reject All Unconfirmed Hackers
         $Hackers_v2 = Hacker::all() ;
         $now = Carbon::now();
         $limit = 2 ;
         foreach ($Hackers_v2 as $hacker ) {
             $recieved_date = Carbon::parse($hacker->accepted_email_received_at)->addDays($limit) ;
             if($recieved_date->lt($now)) {
                 $hacker->reject();
                 $hacker->save();
             }
         }

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
        // Return Hackers DataTable
        return view('dashboard.hackers', ['hackers' => $hackers]);
    }

    public function update(SetDecisionRequest $request, Hacker $hacker)
    {
        $decision = $request->request->get('decision');
        $hacker->decision = $decision;
        $result = $hacker->save();
        return response()->json([
            'response' => $result,
        ]);

    }
}
