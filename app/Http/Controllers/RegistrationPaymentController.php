<?php namespace AllAccessRMS\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Http\Middleware\AttendeeRegistrationPayment;

use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\Http\Requests\PaymentFormRequest;

class RegistrationPaymentController extends Controller
{

    protected $attendeeRepository;

    protected $eventRepository;

    public function __construct(AttendeeRepositoryInterface $attendees, EventRepositoryInterface $events)
    {

        $this->middleware('event_payment');

        $this->attendeeRepository = $attendees;

        $this->eventRepository = $events;
    }

    public function getPayment($eventId, $attendeeId)
    {

        $event = $this->eventRepository->findById($eventId);

        $attendee = $this->attendeeRepository->findById($attendeeId);

        return view('public.events.payment', compact('event', 'attendee'));
    }

    public function postPayment(PaymentFormRequest $request, $eventId, $attendeeId)
    {
        //$registeredAttendee = $this->attendees->findById($attendeeId);
        $event = $this->events->findById($eventId);

        $input = $request->all();
        $token = ['stripeToken'];

        try {

        } catch (Exception $e) {

        }
    }
}
