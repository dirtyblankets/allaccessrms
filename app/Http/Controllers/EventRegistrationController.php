<?php namespace AllAccessRMS\Http\Controllers;

use Exception;
use Laracasts\Flash\Flash;
use AllAccessRMS\Http\Requests\EventRegistrationFormRequest;

use AllAccessRMS\Core\Utilities\States;
use AllAccessRMS\Core\Utilities\Grades;
use AllAccessRMS\Core\Utilities\Gender;
use AllAccessRMS\Core\Utilities\Languages;
use AllAccessRMS\Core\Utilities\SweatshirtSizes;

use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;
use AllAccessRMS\AllAccessEvents\AttendeeInvitationRepositoryInterface;

use AllAccessRMS\AllAccessEvents\EventRegistrationValidator;

use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;

use AllAccessRMS\Jobs\RegisterAttendee;

class EventRegistrationController extends Controller
{

    protected $eventRepo;

    protected $orgRepo;

    protected $attendeeRepository;

    protected $guests;

    public function __construct(EventRepositoryInterface $eventRepo,
                                    OrganizationRepositoryInterface $orgRepo,
                                        AttendeeRepositoryInterface $attendeeRepository,
                                            AttendeeInvitationRepositoryInterface $guests)
    {
        $this->eventRepo = $eventRepo;
        $this->orgRepo = $orgRepo;
        $this->attendeeRepository = $attendeeRepository;
        $this->guests = $guests;
    }


    /**
     * Display Registration Page
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getRegistration($id)
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

        if ($event->private)
        {
            Flash::overlay('Note: This is a private event.  Your email must be on the guest list to process registration.');
        }

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
    public function postRegistration(EventRegistrationFormRequest $request)
    {

        $event_id = $request->input('event_id');
        $attendee_email = $request->input('attendee.email');

        $event = $this->eventRepo->findById($event_id);
        
        if ($event->private)
        {
            $attendee = $this->guests->findByEmail($attendee_email);

            if ($attendee->isEmpty())
            {
                $msg = "We are sorry, you have not yet been added to the guest list.  Please contact the organizer of this event for more info.";
                return redirect()->back()->withInput()->withErrors([$msg]);
            }
        }

        $eventRegistrationValidator = new EventRegistrationValidator($this->eventRepo, $this->attendeeRepository);
        if ($eventRegistrationValidator->noEventCapacity($event_id))
        {
            $msg = "We're sorry, the event is now at full capacity.";
            return redirect()->back()->withInput()->withErrors([$msg]);
        }

        $job = new RegisterAttendee($request);
        $this->dispatch($job);

        $attendee = $this->attendeeRepository->findByEventAndEmail($event_id, $attendee_email);

        if (empty($attendee->id)) 
        {
            // Something went wrong if we're in here: the attendee should've been registered

            // To Do: create unique exception classes for unique handling
            throw new Exception("Unable to find Registered Attendee.");
        }

        Flash::success('Thank you! You have been registered! A confirmation email have been sent.');
        return redirect()->route('event.payment', [ $event, $attendee ]);
    
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

        return view('public.events.show', 
                    compact('event', 
                            'eventsite', 
                            'hostOrg',
                            'organizationinfo', 
                            'partners', 
                            'organizations'));
    }

}
