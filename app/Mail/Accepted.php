<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Accepted extends Mailable
{
    use Queueable, SerializesModels;

    public $confirmation_link;

    /**
     * Create a new message instance.
     *
     * @param $confirmation_link
     */
    public function __construct($confirmation_link)
    {
        $this->confirmation_link = $confirmation_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.accepted')->subject('HackIT Decision');
    }
}
