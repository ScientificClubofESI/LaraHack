<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hacker extends Model
{
    protected $fillable=[
        "id",
        "first_name",
        "last_name",
        "email",
        "birthday",
        "sex",
        "phone_number",
        "motivation",
        "github",
        "linked_in",
        "skills",
        "size",
        "team_id",
        "decision",
    ];

    public function team(){
        if ($this->hasTeam()) return $this->belongsTo('App\team');
        else return null;
    }

    public function hasTeam(){
        if ($this->team_id!=null) return true;
        else return false;
    }

    public function confirmAttendance(){
        $this->confirmed = true;

    }
    public function reject(){
        $this->decision = 'rejected';
    }
}
