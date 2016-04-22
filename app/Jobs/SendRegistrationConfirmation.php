<?php namespace AllAccessRMS\Jobs;

use AllAccessRMS\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
//use Illuminate\Contracts\Queue\ShouldQueue;

use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AllAccessEvents\Event;

class SendRegistrationConfirmation extends Job implements SelfHandling
{

	protected $data;

    public function __construct(Attendee $newAttendee, Event $event)
    {

        $this->data = array(
            'toEmail' => $newAttendee->email,
            'toName' => $newAttendee->firstname . ' ' . $newAttendee->lastname,
            'emailBody' => 'You have registered for the following event: ' . $event->title,
            'linkToEvent' => 'https://allaccessrms.dev/event/show/' . $event->id, 
        );
	}

    public function handle(Mailer $mailer)
    {

        $mailer->send('emails.registration_confirmation', $this->data, function ($m) {
            
            $m->from('administrator@allaccess.dev', 'All Access RMS');
            
            $m->to('kapchoi@yahoo.com', $this->data['toName'])->subject('Registration Confirmation');
        });
    }

}
