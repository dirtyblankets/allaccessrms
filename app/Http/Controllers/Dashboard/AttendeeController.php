<?php namespace AllAccessRMS\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

    public function search($event_id)
    {
        //$view = View::make('admin.attendees.index');
        //if(Request::ajax()) {
        $sections = view('admin.attendees.index')->renderSections(); // returns an associative array of 'content', 'head' and 'footer'

        return $sections['content']; // this will only return whats in the content section

        //}

        $search_name = Input::get('search_name');
        dd($search_name);
    }


}
