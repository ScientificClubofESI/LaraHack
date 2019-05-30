<?php

namespace App\Http\Controllers\Admin;

use App\Hacker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{

    /**
     * Statistics view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //Decisions Chart

        $hackers = Hacker::all();
        $number_of_all_hackers = count($hackers);

        $hackers = Hacker::all()->where('decision','=','not_yet');
        $number_of_not_viewed_hackers = count($hackers);

        $hackers = Hacker::all()->where('decision','=','accepted');
        $number_of_accepted_hackers = count($hackers);

        $hackers = Hacker::all()->where('decision','=','rejected');
        $number_of_rejected_hackers = count($hackers);

        $hackers = Hacker::all()->where('decision','=','waiting_list');
        $number_of_waiting_hackers = count($hackers);

        $decisions_chart = [
            'all' => $number_of_all_hackers,
            'not_yet' => $number_of_not_viewed_hackers,
            'accepted' => $number_of_accepted_hackers,
            'rejected' => $number_of_rejected_hackers,
            'waiting' => $number_of_waiting_hackers,
        ];

        //T-shirt size chart

        $hackers = Hacker::all()->where('size','=','XL')->where('decision','=','accepted');
        $number_of_xl_tshirts = count($hackers);

        $hackers = Hacker::all()->where('size','=','L')->where('decision','=','accepted');
        $number_of_l_tshirts = count($hackers);

        $hackers = Hacker::all()->where('size','=','M')->where('decision','=','accepted');
        $number_of_m_tshirts = count($hackers);

        $hackers = Hacker::all()->where('size','=','S')->where('decision','=','accepted');
        $number_of_s_tshirts = count($hackers);

        $size_chart=[
            'XL' => $number_of_xl_tshirts,
            'L' => $number_of_l_tshirts,
            'M' => $number_of_m_tshirts,
            'S' => $number_of_s_tshirts,
        ];

        //Sexe chart

        $hackers = Hacker::all()->where('sex','=','male')->where('decision','=','accepted');
        $number_of_male_hackers = count($hackers);

        $hackers = Hacker::all()->where('sex','=','female')->where('decision','=','accepted');
        $number_of_female_hackers = count($hackers);

        $gender_chart=[
            'male' => $number_of_male_hackers,
            'female' => $number_of_female_hackers
        ];

        //Registration per day chart

        $hackers = Hacker::all('created_at');

        $i = 0;
        $dates = [];
        foreach ($hackers as $hacker){
            $dates[$i]= $hacker->created_at->format('Y/m/d-D');
            $i++;
        }

        $inscription_date_chart=array_count_values($dates);

        return view('dashboard.statistics',['decision_chart'=>$decisions_chart,'size_chart'=>$size_chart,'gender_chart'=>$gender_chart,'inscription_date_chart'=>$inscription_date_chart]);
    }
}
