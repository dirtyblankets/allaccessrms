<?php namespace AllAccessRMS\Http\Controllers;

use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;
//use AllAccessRMS\AllAccessEvents\Event;
//use AllAccessRMS\AllAccessEvents\EventSite;
//use AllAccessRMS\Accounts\Organizations\PartnerOrganization;

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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        $organization = $this->orgRepo->findById($event->organization_id);
        $organizationinfo = $organization->info()->first();
        $partners = $event->partners()->get();

        return view('public.events.show', compact('event', 'eventsite', 'organization',
            'organizationinfo', 'partners'));
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
