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

    public function getPaymentOnline($eventId, $attendeeId)
    {

        $event = $this->eventRepository->findById($eventId);

        $attendee = $this->attendeeRepository->findById($attendeeId);

        dd(boolval(doubleval("125") === doubleval($event->price)));
        return view('public.events.payment', compact('event', 'attendee'));
    }

    public function postPaymentOnline()
    {

    }
}
