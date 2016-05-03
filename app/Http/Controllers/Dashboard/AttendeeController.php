<?php namespace AllAccessRMS\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;

class AttendeeController extends Controller
{

    protected $attendees;

    public function __construct(AttendeeRepositoryInterface $attendees)
    {
        $this->beforeFilter('auth');

        $this->attendees = $attendees;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('dashboard/index', compact('events'));
    }


}
