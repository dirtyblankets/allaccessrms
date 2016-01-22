<?php namespace AllAccessRMS\Http\Controllers\Admin;

use Illuminate\Http\Request;

use AllAccessRMS\Models\Event;
use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\AllAccessRMS\Repositories\EventRepositoryInterface;

class EventController extends Controller
{
    private $eventRepo;

    public function __construct(EventRepositoryInterface $events)
    {
        $this->eventRepo = $events;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return \View::make('events/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return "Create New Events Page.";
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
        //
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
