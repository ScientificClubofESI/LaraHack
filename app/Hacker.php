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

    public $dates = ['accepted_email_received_at'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function hasTeam()
    {
        return (bool) ! is_null($this->team);
    }

    public function confirmAttendance(){
        $this->confirmed = true;

    }
    public function reject(){
        $this->decision = 'rejected';
    }
}
