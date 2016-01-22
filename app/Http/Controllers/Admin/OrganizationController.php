<?php namespace AllAccessRMS\Http\Controllers\Admin;

use Log;
use Exception;
use AllAccessRMS\Exceptions\Handler;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Http\Requests\NewOrganizationFormRequest;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;
use AllAccessRMS\Jobs\RegisterPartnerOrganization;

class OrganizationController extends Controller {
    
    protected $organizationsRepository;

    public function __construct(OrganizationRepositoryInterface $organizationsRepository)
    {
        $this->organizationsRepository = $organizationsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $organizations = $this->organizationsRepository->findAllPaginated();
        } catch (Exception $e) {
            Log::error($e);
        }
        return view('organizations/index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(NewOrganizationFormRequest $request)
    {
        try {
            $job = new RegisterPartnerOrganization($request);
            $this->dispatch($job);

            return redirect()->route('admin::organizations');
        } catch (Exception $e) {
            Log::error($e);
        }
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
