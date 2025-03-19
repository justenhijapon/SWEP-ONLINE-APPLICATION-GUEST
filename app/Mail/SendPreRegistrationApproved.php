<?php
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\User\PreRegistrationModel;
use Illuminate\Support\Str;


class SendPreRegistrationApproved extends Mailable
{
    use Queueable, SerializesModels;
    public $applicant;
//    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($applicant)
    {
//        $this->data = $data;
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $userSlug = Auth::guard('web')->user()->slug;
        $recipients = PreRegistrationModel::where('user_created', $userSlug)->first();


        $dateNow = strtoupper(date('Ymd')); // Current date in YYYYMMDD format in uppercase
        $randomStr = strtoupper(Str::random(5)); // 5 random characters in uppercase
        $result = $dateNow .'-'. $randomStr;

      return $this->subject('SRA|Clearance for Imported Commodities - ' .$result)
          ->view('mailables.preRegistrationApproved')
          ->with(['applicant' => $this->applicant]);

    }

}