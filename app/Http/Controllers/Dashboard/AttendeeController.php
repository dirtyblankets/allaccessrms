<?php namespace AllAccessRMS\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;

class AttendeeController extends Controller
{

    protected $attendees;

    protected $events;

    public function __construct(AttendeeRepositoryInterface $attendees, 
                                    EventRepositoryInterface $events)
    {
        $this->beforeFilter('auth');

        $this->attendees = $attendees;

        $this->events = $events;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($event_id)
    {
        $event = $this->events->findById($event_id);
        $attendees = $this->attendees->findAllPaginatedByEvent($event_id, 'lastname', 'registration_date');

        return view('admin.attendees.index', compact('attendees', 'event'));
    }


}
