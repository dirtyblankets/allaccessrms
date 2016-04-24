<?php namespace AllAccessRMS\Jobs;

use Log;
use AllAccessRMS\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AllAccessEvents\Event;

class SendRegistrationConfirmation extends Job implements SelfHandling, ShouldQueue
{

    use InteractsWithQueue, SerializesModels;

    protected $newAttendee;

    protected $event;

	protected $data;

    public function __construct(Attendee $newAttendee, Event $event)
    {

        $this->newAttendee = $newAttendee;

        $this->event = $event;

        $this->data = array(
            'toEmail' => $this->newAttendee->email,
            'toName' => $this->newAttendee->firstname . ' ' . $this->newAttendee->lastname,
            'emailBody' => 'You have registered for the following event: ' . $this->event->title,
            'linkToEvent' => 'https://allaccessrms.dev/event/show/' . $this->event->id, 
        );

	}

    public function handle(Mailer $mailer)
    {

        $mailer->send('emails.registration_confirmation', $this->data, function ($m) {
            
            $m->from('administrator@allaccess.dev', 'All Access RMS');
            
            $m->to('kapchoi@yahoo.com', $this->data['toName'])->subject('Registration Confirmation');
        });

        Log::info('Send Confirmation Email Job Executed on '. date('Y m d H:i:s'));
    }

    public function failed()
    {
        Log::error('SendRegistrationConfirmation Job failed.');
    }
}
