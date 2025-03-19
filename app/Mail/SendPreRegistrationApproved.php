<?php
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;


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
//        $data =$this->data;
      return $this->subject('Applicant Approved')
          ->view('mailables.preRegistrationApproved')
          ->with(['applicant' => $this->applicant]);

    }

}