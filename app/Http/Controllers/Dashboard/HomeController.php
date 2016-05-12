<?php namespace AllAccessRMS\Http\Controllers\Dashboard;

use Auth;
use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;

use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\PartnerOrganization;
use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;

class HomeController extends Controller
{

    protected $events;

    protected $attendees;

    public function __construct(EventRepositoryInterface $events,
                                    AttendeeRepositoryInterface $attendees)
    {
        $this->beforeFilter('auth');

        $this->events = $events;
        $this->attendees = $attendees;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->is('owner|admin'))
        {
            return $this->goToAdminDashboard();
        }
        else if (Auth::user()->is('moderator'))
        {
            return $this->goToModeratorDashboard();
        }
    }

    private function goToAdminDashboard()
    {
        $events = $this->events->getActiveEvents();
       
        return view('admin.dashboard.index', compact('events'));   
    }

    private function goToModeratorDashboard()
    {
        $organizationId = Auth::user()->organization_id;

        // If the moderator belongs to a Partner Organization
        if (Auth::user()->organization()->first()->isChild())
        {
            $events = PartnerOrganization::find($organizationId)->events()->get();
        }
        else
        {
            $events = Event::where('organization_id', $organizationId)->get();
        }

        return view('admin.dashboard.index', compact('events')); 
    }


}
