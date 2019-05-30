<?php

namespace App\Http\Controllers\Admin;

use App\Hacker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CheckinController extends Controller
{
    public function index()
    {
        $confirmedHackers = DB::table('hackers')
            ->where('confirmed' , '=' , 1)
            ->join('teams', 'hackers.team_id', '=', 'teams.id')
            ->select('hackers.id as id', 'hackers.first_name as first_name',
                'hackers.last_name as last_name', 'hackers.email as email', 'hackers.phone_number as phone_number',
                'hackers.checked as checked', 'hackers.size as size', 'teams.name as team_name')
            ->orderBy('team_name')
            ->get(); // Getting all hackers with team and their teams name

        $confirmedHackersNoTeam = DB::table('hackers')->where('confirmed' , '=' , 1)->whereNull('team_id')->get(); // Getting all hackers without a team

        $confirmedHackers = $confirmedHackers->merge($confirmedHackersNoTeam); // Putting all in one table

        return view('dashboard.checkin', ['hackers' => $confirmedHackers]);
    }

    public function update(Request $request, Hacker $hacker)
    {
        if ($hacker->checked) $hacker->checked = 0 ;
        else $hacker->checked = 1 ;
        $hacker->save();
        return response(200);
    }
}
