<?php namespace AllAccessRMS\Http\Controllers\Owner;

use Auth;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;

use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Http\Requests\AllAccessEventFormRequest;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\Jobs\PublishEvent;

class AllAccessEventsController extends Controller
{
    private $eventRepo;

    public function __construct(EventRepositoryInterface $events)
    {
        $this->beforeFilter('auth');
        $this->eventRepo = $events;
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
        return view('events/create');
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

        return view('events.edit', ['event' => $event, 'eventsite'=>$eventsite]);
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
