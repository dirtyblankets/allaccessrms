<?php namespace AllAccessRMS\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;

use AllAccessRMS\Jobs\Job;

use AllAccessRMS\AllAccessEvents\AttendeeRepository;

class UpdateAttendee extends Job implements SelfHandling
{

    protected $request;

    protected $attendeeId;

    public function __construct($request, $attendeeId)
    {
        $this->request = $request;

        $this->attendeeId = $attendeeId;
    }

    public function handle()
    {

        $attendeeRepository = new AttendeeRepository();
        
        $attendee = $attendeeRepository->findById($this->attendeeId);
        
        $event = $attendee->event()->first();

        if ($attendee->amount_paid == $event->price
                || $this->request->input('fees_paid') > $event->price)
        {
            // Don't set fees paid.
        }
        else
        {
            $attendee->amount_paid = $this->request->input('fees_paid');
        }

        $attendee->save();
    }
}