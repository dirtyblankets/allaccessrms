<?php namespace AllAccessRMS\Http\Controllers;

use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;

use AllAccessRMS\Http\Requests\AllAccessEventFormRequest;
use AllAccessRMS\AllAccessEvents\Attendee;

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

    public function register(AllAccessEventFormRequest $request)
    {
        dd($request->input('attendee.organization_id'));
        $event = $this->eventRepo->findById($request->input('event_id'));
        Attendee::create(array(
            'organization_id' => $request->input('organization'),
            'firstname' =>  $request->input('attendee.firstname'),
            'lastname'  =>  $request->input('attendee.lastname'),
            'email'     =>  $request->input('attendee.email')
        ));
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
