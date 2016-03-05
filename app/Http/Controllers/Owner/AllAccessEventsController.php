<?php namespace AllAccessRMS\Http\Controllers\Owner;

use Auth;
use JavaScript;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use AllAccessRMS\Core\Utilities\States;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;
use AllAccessRMS\Http\Requests\AllAccessEventFormRequest;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;


use AllAccessRMS\Jobs\AllAccessEvents\CreateEvent;
use AllAccessRMS\Jobs\AllAccessEvents\UpdateEvent;

class AllAccessEventsController extends Controller
{
    private $eventRepo;

    private $orgRepo;

    public function __construct(EventRepositoryInterface $events, OrganizationRepositoryInterface $organization)
    {
        $this->beforeFilter('auth');
        $this->eventRepo = $events;
        $this->orgRepo = $organization;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $events = $this->eventRepo->findAllPaginatedOrderedByDate();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $guests = collect([]);
        $states = States::all();
        $partners = $this->orgRepo->getPartnerOrganizations(Auth::user()->organization_id);
        $partners = $partners->sortBy('name');

        return view('events/create', compact('partners', 'states', 'guests'));
    }

    /**
     * Add guests entered in modal to grid on create view.
     * @return Response
     */
    public function addgueststoview()
    {
        $guests = Input::get('guests_email');
        // split email address by space, comma, colon, or semi-colon
        $emailfromform = preg_split("/[\s,;:]+/", $guests);
        // Put them back together separated by a comma
        // string form
        $emailfromform = implode(",", $emailfromform);
        $guests_email = $emailfromform;
        // put it back into array form
        $guests = collect(explode(",", $emailfromform));
        $rules = array(
            'guests_email' => 'email',
        );

        foreach ($guests as $email)
        {
            $validator = Validator::make(array('guests_email' => $email), $rules);
            if ($validator->fails())
            {
                $openModal = 'true';
                return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput(['openModal'=>$openModal, 'guests_email'=>$guests_email]);
            }
        }

        $states = States::all();
        $partners = $this->orgRepo->getPartnerOrganizations(Auth::user()->organization_id);
        $partners = $partners->sortBy('name');
        return view('events/create', compact('partners', 'states', 'guests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AllAccessEventFormRequest $request)
    {
        $organization = Organization::where('id', Auth::user()->organization_id)->first();

        $job = new CreateEvent($request, $organization);
        $this->dispatch($job);

        Flash::success('New Event Published!');
        return redirect()->route('owner::events');
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

        return view('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepo->findById($id);
        $eventsite = $event->eventsite()->first();
        $selectedPartners = $event->partners()->get();
        $selectedPartnersId = $selectedPartners->lists('id')->toArray();

        $partners = $this->orgRepo->getPartnerOrganizations(Auth::user()->organization_id);
        return view('events.edit', compact('event', 'eventsite', 'partners', 'selectedPartnersId'));
    }

    public function unpublish($id)
    {
        $event = $this->eventRepo->findById($id);    
        $event->published = false;
        $event->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AllAccessEventFormRequest $request, $id)
    {
        $event = $this->eventRepo->findById($id);

        if (!$event->published)
        {
            $job = new UpdateEvent($request, $event);
            $this->dispatch($job);

            Flash::success('Event updated!');
            return redirect()->back();
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->eventRepo->findById($id);
        $event->delete();

        Flash::success('Event Deleted!');
        return redirect()->route('owner::events');
    }
}
