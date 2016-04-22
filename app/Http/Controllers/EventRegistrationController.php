<?php namespace AllAccessRMS\Http\Controllers;

use Exception;
use Laracasts\Flash\Flash;
use AllAccessRMS\Http\Requests\EventRegistrationFormRequest;

use AllAccessRMS\Core\Utilities\States;
use AllAccessRMS\Core\Utilities\Grades;
use AllAccessRMS\Core\Utilities\Gender;
use AllAccessRMS\Core\Utilities\Languages;
use AllAccessRMS\Core\Utilities\SweatshirtSizes;

use AllAccessRMS\AllAccessEvents\AttendeeRepository;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;

use AllAccessRMS\Jobs\AllAccessEvents\RegisterAttendee;

class EventRegistrationController extends Controller
{

    private $eventRepo;

    private $orgRepo;

    public function __construct(EventRepositoryInterface $eventRepo,
                                OrganizationRepositoryInterface $orgRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->orgRepo = $orgRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }


    /**
     * Display Registration Page
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function registration($id)
    {
        $event = $this->eventRepo->findById($id);

        $hostOrg = $this->orgRepo->findById($event->organization_id);

        $partners = $event->partners()->get();
        $partners->prepend($hostOrg);
        $partners->prepend('');

        $organizations = $partners->lists('name', 'id');

        $states = States::all();
        $grades = Grades::all();
        $genders = Gender::all();
        $languages = Languages::all();
        $sweatshirt_sizes = SweatshirtSizes::all();

        return view('public.events.registration', 
            compact(
                'event', 
                'organizations', 
                'states', 
                'languages', 
                'grades', 
                'sweatshirt_sizes',
                'genders'));
    }

    /**
     * Process Registration
     * @param  EventRegistrationFormRequest $request [description]
     * @return [type]                                [description]
     */
    public function register(EventRegistrationFormRequest $request)
    {
        $job = new RegisterAttendee($request);
        $this->dispatch($job);

        $event_id = $request->input('event_id');
        $event = $this->eventRepo->findById($event_id);

        $attendee_email = $request->input('attendee.email');

        $attendeeRepo = new AttendeeRepository();
        $newAttendee = $attendeeRepo->findByEventAndEmail($event_id, $attendee_email);

        if (empty($newAttendee->id)) {
            throw new Exception("Unable to find Registered Attendee.");
        }

        $session_data = array(
            'event_id' => $event_id,
            'attendee_email' => $attendee_email,
            'attendee_id' => $newAttendee->id,
            'event_price' => $event->price,
        );

        Flash::success('Thank you! You have been registered! A confirmation email have been sent.');
        return redirect('event/pay_online')->with('registration_data', $session_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $event = $this->eventRepo->findById($id);
        $eventsite = $event->eventsite()->first();

        $hostOrg = $this->orgRepo->findById($event->organization_id);
        $organizationinfo = $hostOrg->info()->first();

        $partners = $event->partners()->get();
        $partners->prepend($hostOrg);

        $organizations = $partners->lists('name', 'id');

        return view('public.events.show', compact('event', 'eventsite', 'hostOrg',
            'organizationinfo', 'partners', 'organizations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
