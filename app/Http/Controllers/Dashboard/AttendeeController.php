<?php namespace AllAccessRMS\Http\Controllers\Dashboard;


use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;

use AllAccessRMS\Core\Utilities\States;
use AllAccessRMS\Core\Utilities\SweatshirtSizes;
use AllAccessRMS\Core\Utilities\Gender;
use AllAccessRMS\Core\Utilities\Languages;
use AllAccessRMS\Core\Utilities\Grades;

use AllAccessRMS\Jobs\SendInvoiceEmail;
use AllAccessRMS\Jobs\SendRegistrationConfirmation;
use AllAccessRMS\Jobs\UpdateAttendee;

use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;

class AttendeeController extends Controller
{

    protected $attendees;

    protected $events;

    public function __construct(AttendeeRepositoryInterface $attendees, 
                                    EventRepositoryInterface $events)
    {
        $this->beforeFilter('auth');

        $this->attendees = $attendees;

        $this->events = $events;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($event_id)
    {
        $event = $this->events->findById($event_id);
        $attendees = $this->attendees->findAllPaginatedByEvent($event_id, 'lastname', 'registration_date');

        return view('attendees.index', compact('attendees', 'event'));
    }

    public function search($event_id)
    {
        $searchLastName = Input::get('search_last_name');
        $searchFirstName = Input::get('search_first_name');
        $searchFeeStatus = Input::get('search_payment_status');

        dd($searchFeeStatus);
        
        $search_conditions = array(
            'firstname' =>  $searchFirstName,
            'lastname'  =>  $searchLastName,
            'fee_status'    =>  $searchFeeStatus,
        );

        $attendees = $this->attendees->search($event_id, $search_conditions);

        return redirect()->back()->with(compact('attendees'));
    }

    /**
     * [show description]
     * @param  [type] $id [attendee id]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $attendee = $this->attendees->findById($id);

        $attendee_application_form = $attendee->application_form()->first();

        $attendee_health_release_form = $attendee->health_release_form()->first();

        $event = $attendee->event()->first();

        $sweatshirt_sizes = SweatshirtSizes::all();

        $states = States::all();

        $genders = Gender::all();
        
        $languages = Languages::all();

        return view('attendees.show', compact(
            'attendee', 
            'attendee_application_form', 
            'attendee_health_release_form',
            'sweatshirt_sizes',
            'states',
            'genders',
            'languages',
            'event'));
    }

    public function edit($id)
    {
        $attendee = $this->attendees->findById($id);

        $event = $attendee->event()->first();

        $hostOrg = $event->organization()->first();

        $organizations = $event->partners()->get();
        $organizations->prepend($hostOrg);

        $attendee_organization = $attendee->organization()->first();
        $organizations->forget($attendee_organization->id);
        $organizations->prepend($attendee_organization);

        $organizations = $organizations->lists('name', 'id');

        $attendee_application_form = $attendee->application_form()->first();

        $attendee_health_release_form = $attendee->health_release_form()->first();

        $sweatshirt_sizes = SweatshirtSizes::all();

        $states = States::all();

        $genders = Gender::all();
        
        $languages = Languages::all();

        $grades = Grades::all();

        return view('attendees.edit', compact(
            'attendee', 
            'attendee_application_form', 
            'attendee_health_release_form',
            'sweatshirt_sizes',
            'states',
            'genders',
            'languages',
            'organizations',
            'grades'));
    }

    public function update(Request $request, $id)
    {
        $this->dispatch(new UpdateAttendee($request, $id));

        return redirect()->back();
    }

    public function sendInvoice($id)
    {

        $attendee = $this->attendees->findById($id);

        $this->dispatch(new SendInvoiceEmail($attendee));

        Flash::overlay('Invoice sent!');

        return redirect()->back();
    }

    public function sendRegistrationConfirmation($id)
    {
        $attendee = $this->attendees->findById($id);

        $event = $attendee->event()->first();

        $this->dispatch(new SendRegistrationConfirmation($attendee, $event));

        Flash::overlay('Registration confirmation sent!');

        return redirect()->back();
    }

}
