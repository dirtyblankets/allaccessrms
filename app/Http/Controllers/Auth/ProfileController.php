<?php namespace AllAccessRMS\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;

use AllAccessRMS\Core\Utilities\States;
use AllAccessRMS\Accounts\Users\UserRepositoryInterface;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;
use AllAccessRMS\Http\Requests\UpdateOrganizationInfoFormRequest;
use AllAccessRMS\Jobs\UpdateOrganizationInfo;

class ProfileController extends Controller
{

    protected $organizations;

    public function __construct(OrganizationRepositoryInterface $organizations)
    {
        $this->beforeFilter('auth');

        $this->organizations = $organizations;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization = $this->organizations->findById(Auth::user()->organization_id);

        $states = States::all();

        return view('profile.index', compact('states', 'organization'));
    }

    public function organization_info_update(UpdateOrganizationInfoFormRequest $request, $id)
    {
        $updateOrganization = new UpdateOrganizationInfo($request, $id);
        $this->dispatch($updateOrganization);

        Flash::overlay('Organization Info Updated!');

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        return view('profile.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
