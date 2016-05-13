<?php namespace AllAccessRMS\Http\Controllers\Dashboard;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Input;

use Laracasts\Flash\Flash;
use Log;
use Exception;
use AllAccessRMS\Core\Utilities\States;
use AllAccessRMS\Exceptions\Handler;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Http\Requests\NewOrganizationFormRequest;
use AllAccessRMS\Http\Requests\UpdateOrganizationInfoFormRequest;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;
use AllAccessRMS\Accounts\Users\UserRepositoryInterface;
use AllAccessRMS\Jobs\RegisterPartnerOrganization;
use AllAccessRMS\Jobs\UpdateOrganizationInfo;

class OrganizationController extends Controller {
    
    protected $organizations;

    protected $userRepository;

    public function __construct(OrganizationRepositoryInterface $organizations,
                                    UserRepositoryInterface $userRepository)
    {
        $this->beforeFilter('auth');

        $this->organizations = $organizations;

        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        if ($sortby && $order)
        {
            $organizations = $this->organizations->findAllPaginatedSorted($sortby, $order);
        } 
        else 
        {
            $organizations = $this->organizations->findAllPaginated();
        }

        return view('organizations.index', compact('organizations', 'sortby', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $states = States::all();
        return view('organizations.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(NewOrganizationFormRequest $request)
    {

        $job = new RegisterPartnerOrganization($request);

        $this->dispatch($job);

        return redirect()->route('organizations');

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
        $organization = $this->organizations->findById($id);
        $info = $organization->info()->first();
        $states = States::all();

        return view('organizations.edit', compact('organization', 'states', 'info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateOrganizationInfoFormRequest $request, $id)
    {
        $this->dispatch(new UpdateOrganizationInfo($request, $id));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $organization = $this->organizations->findById($id);

        $organization->delete();

        return redirect()->route('organizations');
    }
}
