<?php namespace AllAccessRMS\Http\Controllers\Owner;

use Auth;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;

use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\PartnerOrganization;
use AllAccessRMS\Http\Requests\AllAccessEventFormRequest;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;
use AllAccessRMS\Jobs\PublishEvent;

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
        $partners = $this->orgRepo->getPartnerOrganizations(Auth::user()->organization_id);
        $partners = $partners->sortBy('name');

        return view('events/create', compact('partners'));
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

        $job = new PublishEvent($request, $organization, null);
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

    public function unpublish(Request $request, $id)
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
            $job = new PublishEvent($request, $event->organization()->first(), $event);
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
