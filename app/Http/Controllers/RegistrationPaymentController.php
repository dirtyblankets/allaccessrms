<?php namespace AllAccessRMS\Http\Controllers;

use Exception;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Http\Middleware\AttendeeRegistrationPayment;

use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\Http\Requests\PaymentFormRequest;
use AllAccessRMS\Jobs\SendInvoiceEmail;

class RegistrationPaymentController extends Controller
{

    protected $attendees;

    protected $events;

    public function __construct(AttendeeRepositoryInterface $attendees, 
                                    EventRepositoryInterface $events)
    {

        $this->middleware('event_payment');

        $this->attendees = $attendees;

        $this->events = $events;
    }

    public function getPayment($eventId, $attendeeId)
    {

        $event = $this->events->findById($eventId);

        $attendee = $this->attendees->findById($attendeeId);

        return view('public.events.payment', compact('event', 'attendee'));
    }

    public function postPayment(PaymentFormRequest $request, $eventId, $attendeeId)
    {
        $registeredAttendee = $this->attendees->findById($attendeeId);
        $event = $this->events->findById($eventId);

        $input = $request->all();
        $token = $input['stripeToken'];

        if (empty($token))
        {
            Flash::error('Your order could not be processed.  Please ensure javascript in enabled and try again.');
            return redirect()->back();
        }

        try {

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            
            $stripeCustomer = \Stripe\Customer::create([
                'source'    =>  $token,
                'description'   =>  'Stripe charge for AARMS customer: ' . $registeredAttendee->id,
                'email'     =>      $registeredAttendee->email,
            ]);
            

            $charge = \Stripe\Charge::create([
                //'source'    =>  $token,
                'amount'    =>  $event->price_cents,
                'currency'  =>  'usd',
                'customer'  =>  $stripeCustomer->id,
                'description'   =>  'Stripe charge for event: ' . $event->title,

            ]);

            if (!$charge)
            {
                Flash::error("Could not process Credit Card Payment");
                return redirect()->back();
            }
            else
            {
                $registeredAttendee->amount_paid = $event->price;
                $registeredAttendee->save();

                $sendMail = new SendInvoiceEmail($registeredAttendee);
                $this->dispatch($sendMail);
            }


            Flash::success("Payment successful!");
            return redirect()->back();

        } catch (\Stripe\Error\Card $e) {
            
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
}
