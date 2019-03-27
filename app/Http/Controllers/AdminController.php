<?php

namespace App\Http\Controllers;

use App\Hacker;
use App\Http\Requests\SetDecisionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{



    public function index()
    {
        return redirect()->route('statistics');
    }

    /**
     * Display all hackers , regardless if they have a team or not
     *
     * @return \Illuminate\Http\Response
     */
    public function hackers()
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
        return view('hackers', ['hackers' => $hackers]);
    }

    public function settings(){
        return view('settings');
    }

    public function mailing(){
        $hackers=Hacker::all()->where('decision','=','accepted');
        $number_of_accepted_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','rejected');
        $number_of_rejected_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','waiting_list');
        $number_of_waiting_hackers = count($hackers);
        return view('mailing' , ['accepted' => $number_of_accepted_hackers , 'rejected' => $number_of_rejected_hackers , 'waiting' => $number_of_waiting_hackers]);
    }



    public function statistics(){
        $hackers=Hacker::all();
        $number_of_all_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','not_yet');
        $number_of_not_viewed_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','accepted');
        $number_of_accepted_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','rejected');
        $number_of_rejected_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','waiting_list');
        $number_of_waiting_hackers = count($hackers);

        $decisions_chart = [
            'all' => $number_of_all_hackers,
            'not_yet' => $number_of_not_viewed_hackers,
            'accepted' => $number_of_accepted_hackers,
            'rejected' => $number_of_rejected_hackers,
            'waiting' => $number_of_waiting_hackers,
        ];

        $hackers=Hacker::all()->where('size','=','XL')->where('decision','=','accepted');
        $number_of_xl_tshirts = count($hackers);

        $hackers=Hacker::all()->where('size','=','L')->where('decision','=','accepted');
        $number_of_l_tshirts = count($hackers);

        $hackers=Hacker::all()->where('size','=','M')->where('decision','=','accepted');
        $number_of_m_tshirts = count($hackers);

        $hackers=Hacker::all()->where('size','=','S')->where('decision','=','accepted');
        $number_of_s_tshirts = count($hackers);

        $size_chart=[
            'XL' => $number_of_xl_tshirts,
            'L' => $number_of_l_tshirts,
            'M' => $number_of_m_tshirts,
            'S' => $number_of_s_tshirts,
        ];

        $hackers=Hacker::all()->where('sex','=','male')->where('decision','=','accepted');
        $number_of_male_hackers = count($hackers);

        $hackers=Hacker::all()->where('sex','=','female')->where('decision','=','accepted');
        $number_of_female_hackers = count($hackers);

        $gender_chart=[
            'male' => $number_of_male_hackers,
            'female' => $number_of_female_hackers
        ];

        $hackers=Hacker::all('created_at');

        $i = 0;
        $dates = [];
        foreach ($hackers as $hacker){
            $dates[$i]= $hacker->created_at->format('Y/m/d-D');
            $i++;
        }

        $inscription_date_chart=array_count_values($dates);

        //dd($decisions_chart,$size_chart,$gender_chart,$inscription_date_chart);

        //dd(array_keys($inscription_date_chart));

        return view('statistics',['decision_chart'=>$decisions_chart,'size_chart'=>$size_chart,'gender_chart'=>$gender_chart,'inscription_date_chart'=>$inscription_date_chart]);
    }

    /**
     * @param Request $request
     * Setting the decision for a hacker , it can be either accepted , rejected or to the waiting list
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

}
