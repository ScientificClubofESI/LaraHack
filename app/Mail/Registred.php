<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Registred extends Mailable
{
    use Queueable, SerializesModels;

    public $team_name;
    public $team_code;
    public $hacker;

    /**
     * Create a new message instance.
     *
     * @param $team_name
     * @param $team_code
     */
    public function __construct($hacker,$team_name=null,$team_code=null)
    {
        $this->hacker = $hacker;
        $this->team_name = $team_name;
        $this->team_code = $team_code;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registration')->subject('Registration done !');
    }
}
