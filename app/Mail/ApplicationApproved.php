<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ApplicationApproved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function build()
    {

        $dateNow = strtoupper(date('Ymd')); // Current date in YYYYMMDD format in uppercase
        $randomStr = strtoupper(Str::random(5)); // 5 random characters in uppercase
        $result = $dateNow .'-'. $randomStr;

        return $this->subject('Your Application Has Been Approved | '.$result)
            ->view('mailable.application_approved')
            ->with([
                'application' => $this->application
            ]);
    }

}
