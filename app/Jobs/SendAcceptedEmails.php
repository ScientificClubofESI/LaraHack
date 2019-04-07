<?php

namespace App\Jobs;

use App\Mail\Accepted;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendAcceptedEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $hacker;
    public $link;

    /**
     * Create a new job instance.
     *
     * @param $hacker
     * @param $link
     */
    public function __construct($hacker,$link)
    {
        $this->hacker=$hacker;
        $this->link=$link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::to($this->hacker)->queue(new Accepted($this->link,$this->hacker));
    }
}
