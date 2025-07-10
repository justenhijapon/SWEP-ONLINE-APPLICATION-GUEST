<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ApplicationTakeBacked extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $application;
    public $remarks;

    public function __construct($application, $remarks)
    {
        $this->application = $application;
        $this->remarks = $remarks;
    }

    public function build()
    {

        $dateNow = strtoupper(date('Ymd')); // Current date in YYYYMMDD format in uppercase
        $randomStr = strtoupper(Str::random(5)); // 5 random characters in uppercase
        $result = $dateNow .'-'. $randomStr;

        return $this->subject('Your Application Has Been Taken Back | '.$result)
            ->view('mailable.application_take_backed')
            ->with([
                'application' => $this->application,
                'remarks' => $this->remarks
            ]);
    }

}
