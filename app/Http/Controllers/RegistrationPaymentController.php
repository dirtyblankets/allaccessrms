<?php namespace AllAccessRMS\Http\Controllers;

use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;

use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AllAccessEvents\AttendeeRepository;
use AllAccessRMS\AllAccessEvents\EventRepository;

class RegistrationPaymentController extends Controller
{

    protected $attendeeRepository;

    protected $eventRepository;

    public function __construct()
    {
        $this->attendeeRepository = new AttendeeRepository();

        $this->eventRepository = new EventRepository;
    }

    public function paymentPage($eventId, $attendeeId)
    {

        $event = $this->eventRepository->findById($eventId);

        $attendee = $this->attendeeRepository->findById($attendeeId);

        return view('public.events.pay_online', compact('event', 'attendee'));
    }
}
