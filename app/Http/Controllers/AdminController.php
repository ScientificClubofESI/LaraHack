<?php

namespace App\Http\Controllers;

use App\Hacker;
use App\Http\Requests\SetDecisionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminController extends Controller
{



    public function index()
    {
        return redirect()->route('statistics');
    }

    /**
     * Display all hackers , regardless if they have a team or not
     *
     * Update Hackers Decision | Reject All unconfirmed Hackers within a limit
     *
     * @return \Illuminate\Http\Response
     */
    public function hackers()
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


    /**
     * Check-in view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkin()
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

    /**
     * Mailing view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mailing(){
        $hackers=Hacker::all()->where('decision','=','not_yet');
        $number_of_not_viewed_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','accepted');
        $number_of_accepted_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','rejected');
        $number_of_rejected_hackers = count($hackers);

        $hackers=Hacker::all()->where('decision','=','waiting_list');
        $number_of_waiting_hackers = count($hackers);

        return view('dashboard.mailing' , ['accepted' => $number_of_accepted_hackers , 'rejected' => $number_of_rejected_hackers , 'waiting' => $number_of_waiting_hackers , 'not_yet' => $number_of_not_viewed_hackers]);
    }


    /**
     * Statistics view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function statistics(){

        //Decisions Chart

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

        //T-shirt size chart

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

        //Sexe chart

        $hackers=Hacker::all()->where('sex','=','male')->where('decision','=','accepted');
        $number_of_male_hackers = count($hackers);

        $hackers=Hacker::all()->where('sex','=','female')->where('decision','=','accepted');
        $number_of_female_hackers = count($hackers);

        $gender_chart=[
            'male' => $number_of_male_hackers,
            'female' => $number_of_female_hackers
        ];

        //Registration per day chart

        $hackers=Hacker::all('created_at');

        $i = 0;
        $dates = [];
        foreach ($hackers as $hacker){
            $dates[$i]= $hacker->created_at->format('Y/m/d-D');
            $i++;
        }

        $inscription_date_chart=array_count_values($dates);

        return view('dashboard.statistics',['decision_chart'=>$decisions_chart,'size_chart'=>$size_chart,'gender_chart'=>$gender_chart,'inscription_date_chart'=>$inscription_date_chart]);
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

    /**
     * @param Request $request
     * Check or uncheck a hacker
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function checkHacker(Request $request){
        $hacker =  Hacker::find(json_decode($request->getContent())->id);
        if ($hacker->checked) $hacker->checked = 0 ;
        else $hacker->checked = 1 ;
        $hacker->save();
        return response(200);
    }

}
