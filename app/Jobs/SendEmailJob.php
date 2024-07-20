<?php

namespace App\Jobs;

use App\Mail\UpdatePasswordEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $name;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $name)
    {
        $this->user = $user;
        $this->name = $name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new UpdatePasswordEmail($this->name));
    }
}
