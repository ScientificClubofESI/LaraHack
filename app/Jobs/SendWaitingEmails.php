<?php

namespace App\Jobs;

use App\Mail\Waiting;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendWaitingEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $hacker;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($hacker)
    {
        $this->hacker=$hacker;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->hacker)->queue(new Waiting($this->hacker));
    }
}
