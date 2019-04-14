<?php

namespace App\Http\Controllers\Hacker;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCodeRequest;

class TeamController extends Controller
{
    public function show(CheckCodeRequest $request)
    {
        $code = $request->request->get('teamCode');
        $team = DB::table('teams')->where('code', '=', $code)->first();
        if ($team != null) return json_encode(['id' => $team->id, 'team_name' => $team->name]);
        else return json_encode(['error' => 'your code is not valid']);
    }
}
