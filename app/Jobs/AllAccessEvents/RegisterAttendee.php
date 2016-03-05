<?php namespace AllAccessRMS\Jobs\AllAccessEvents;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Jobs\Job;
use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\AllAccessEvents\Attendee;

class RegisterAttendee extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $event = Event::findOrFail($this->request->input('event_id'));

        $newAttendee = new Attendee(array(
            'organization_id'   =>  $this->request->input('attendee.organization_id'),
            'firstname'  =>  $this->request->input('attendee.firstname'),
            'lastname'  =>  $this->request->input('attendee.lastname'),
            'email'     =>  $this->request->input('attendee.email'),
            'registration_date' =>  BaseDateTime::now(),
            'phone_number'  =>  $this->request->input('attendee.phone')
        ));

        dd($newAttendee);
        return $event->attendee()->save($newAttendee);

    }
}