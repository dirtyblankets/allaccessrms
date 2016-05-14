<?php namespace AllAccessRMS\Jobs;

use Log;
use AllAccessRMS\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
//use Illuminate\Contracts\Queue\ShouldQueue;

use AllAccessRMS\AllAccessEvents\Attendee;

class SendInvoiceEmail extends Job implements SelfHandling
{

    //use InteractsWithQueue, SerializesModels;

    protected $attendee;

    public function __construct(Attendee $attendee)
    {
        $this->attendee = $attendee;
    }

    public function handle(Mailer $mailer)
    {
        $email_data = array (
            'name' => $this->attendee->firstname . ' ' . $this->attendee->lastname,
            'event' => $this->attendee->event()->first()->title,
            'payment'  => $this->attendee->amount_paid,
        );

        $mailer->send('emails.invoice', $email_data, function ($m) {

            $m->from('administrator@allaccess.dev', 'All Access RMS');
            
            $m->to('kapchoi@yahoo.com')->subject('Welcome to AllAccessRMS!');
        });

    }

}