<?php

namespace App\Jobs;

use App\Mail\Proposal\ApprovedProposal;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ProcessEmailSending implements ShouldQueue
{
    use Queueable;
    private $studentAccount, $companyFullName, $studentFullName, $vacancyTitle;


    /**
     * Create a new job instance.
     */
    public function __construct($studentAccount, $companyFullName, $studentFullName, $vacancyTitle)
    {
        $this->studentAccount = $studentAccount;
        $this->companyFullName = $companyFullName;
        $this->studentFullName = $studentFullName;
        $this->vacancyTitle = $vacancyTitle;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->studentAccount)
            ->send(new ApprovedProposal($this->companyFullName, $this->studentFullName, $this->vacancyTitle));
    }
}
