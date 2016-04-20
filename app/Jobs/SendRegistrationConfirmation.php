<?php namespace AllAccessRMS\Jobs;

use AllAccessRMS\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
//use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistrationConfirmation extends Job implements SelfHandling
{

	protected $data;

    public function __construct(array $data)
    {

    	$this->data = $data;
	}

    public function handle(Mailer $mailer)
    {

        $mailer->send('emails.registration_confirmation', ['data' => $this->data], function ($m) {
            
            $m->from('administrator@allaccess.dev', 'All Access RMS');
            
            $m->to('kapchoi@yahoo.com', $this->toName)->subject('Registration Confirmation');
        });
    }

}
