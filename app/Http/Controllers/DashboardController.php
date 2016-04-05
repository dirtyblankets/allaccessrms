<?php namespace AllAccessRMS\Http\Controllers;

use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;

class DashboardController extends Controller
{

    protected $events;

    public function __construct(EventRepositoryInterface $events)
    {
        $this->beforeFilter('auth');

        $this->events = $events;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $active_events = $this->events->activeEventsCount();
   
        return view('dashboard/index', ['active_events'=>$active_events]);
    }


}
