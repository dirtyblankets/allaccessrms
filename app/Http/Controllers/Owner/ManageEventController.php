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
use AllAccessRMS\Exceptions\Handler;

use AllAccessRMS\Jobs\AllAccessEvents\CreateEvent;
use AllAccessRMS\Jobs\AllAccessEvents\UpdateEvent;

class ManageEventController extends Controller
{
    private $eventRepo;

    private $eventSiteRepo;

    private $orgRepo;

    public function __construct(EventRepositoryInterface $eventRepo, 
                                    EventSiteRepositoryInterface $eventSiteRepo, 
                                        OrganizationRepositoryInterface $orgRepo)
    {
        $this->beforeFilter('auth');
        $this->eventRepo = $eventRepo;
        $this->orgRepo = $orgRepo;
        $this->eventSiteRepo = $eventSiteRepo;
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

        return redirect()->route('owner::events.edit', [$event->id]);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $event = $this->eventRepo->findById($id);
        $eventsite = $event->eventsite->first();
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
    public function edit($id)
    {
        $event = $this->eventRepo->findById($id);
        $eventsite = $event->eventsite->first();
        $selectedPartners = $event->partners()->get();
        $selectedPartnersId = $selectedPartners->lists('id')->toArray();

        $guests = collect([]);
        $states = States::all();
        $partners = $this->orgRepo->getPartnerOrganizations(Auth::user()->organization_id);
        return view('events.edit', compact('event', 'eventsite', 'partners', 'selectedPartnersId', 'states', 'guests'));
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
