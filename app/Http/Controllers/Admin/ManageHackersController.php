<?php

namespace App\Http\Controllers\Admin;

use App\Hacker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetDecisionRequest;

class ManageHackersController extends Controller
{
    public function index()
    {
        $hackers = Hacker::with('team')->get();

        return view('dashboard.hackers', compact('hackers'));
    }

    public function update(SetDecisionRequest $request, Hacker $hacker)
    {
        $hacker->decision = $request->decision;
        $hacker->save();

        return response(200);
    }
}
