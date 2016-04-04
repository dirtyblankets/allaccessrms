<?php namespace AllAccessRMS\Http\Controllers\Owner;

use Auth;
use Exception;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Core\Utilities\States;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;
use AllAccessRMS\Http\Requests\PublishEventFormRequest;

use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\AllAccessEvents\EventSiteRepositoryInterface;
use AllAccessRMS\AllAccessEvents\AttendeeInvitationRepositoryInterface;
use AllAccessRMS\Exceptions\Handler;

use AllAccessRMS\Jobs\AllAccessEvents\CreateEvent;
use AllAccessRMS\Jobs\AllAccessEvents\UpdateEvent;

class ManageEventController extends Controller
{
    private $eventRepo;

    private $eventSiteRepo;

    private $orgRepo;

    private $eventGuestRepo;

    public function __construct(EventRepositoryInterface $eventRepo, 
                                    EventSiteRepositoryInterface $eventSiteRepo, 
                                        OrganizationRepositoryInterface $orgRepo,
                                            AttendeeInvitationRepositoryInterface $eventGuestRepo)
    {
        $this->beforeFilter('auth');
        $this->eventRepo = $eventRepo;
        $this->orgRepo = $orgRepo;
        $this->eventSiteRepo = $eventSiteRepo;
        $this->eventGuestRepo = $eventGuestRepo;
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
        $event = $this->eventRepo->createEmptyEvent(Auth::user()->organization_id);
        $eventSite = $this->eventSiteRepo->createEmptyEventSite($event->id);

        Flash::overlay("New Event Created!");
        return redirect()->route('owner::events.manage', [$event->id]);
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
        $eventsite = $event->eventsite->get();
        $selectedPartners = $event->partners()->get();
        $selectedPartnersId = $selectedPartners->lists('id')->toArray();

        $guests = collect([]);
        $states = States::all();
        $partners = $this->orgRepo->getPartnerOrganizations(Auth::user()->organization_id);
        return view('events.show', compact('event', 'eventsite', 'partners', 'selectedPartnersId', 'states', 'guests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function manage($id)
    {
        $event = $this->eventRepo->findById($id);
        $eventsite = $event->eventsite()->first();
        $selectedPartners = $event->partners()->get();
        $selectedPartnersId = $selectedPartners->lists('id')->toArray();

        $guests = $this->eventGuestRepo->findAllPaginatedByEvent($event->id);
        $states = States::all();
        $partners = $this->orgRepo->getPartnerOrganizations(Auth::user()->organization_id);
        return view('events.manage', compact('event', 'eventsite', 'partners', 'selectedPartnersId', 'states', 'guests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PublishEventFormRequest $request, $id)
    {
        try 
        {
            $btnType = Input::get('submitBtn');
            $event = $this->eventRepo->findById($id);

            if ($btnType == 'save')
            {
                $job = new UpdateEvent($request, $event, false);
                $this->dispatch($job);

                return redirect()->back();

            }
            else if ($btnType == 'publish')
            {
                $job = new UpdateEvent($request, $event, true);
                $this->dispatch($job);

                Flash::overlay('Your Event has been Published!');
                return redirect()->back();
            }
            else
            {
                throw new Exception("Button not implemented.");
            }

        }
        catch (Exception $e)
        {
            return Handler::HandleError($e);
        } 
    }

    public function unpublish($id)
    {
        $event = $this->eventRepo->findById($id);
        $event->published = false;
        $event->save();

        return redirect()->back();
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
