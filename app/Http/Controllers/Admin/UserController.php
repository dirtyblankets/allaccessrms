<?php namespace AllAccessRMS\Http\Controllers\Admin;

use Auth;
use Exception;
use Laracasts\Flash\Flash;
use Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use AllAccessRMS\Http\Controllers\Controller;

use AllAccessRMS\Http\Requests\AddUserFormRequest;
use AllAccessRMS\Jobs\RegisterNewUser;

use AllAccessRMS\Accounts\Users\Role;
use AllAccessRMS\Accounts\Users\UserRepositoryInterface;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;

class UserController extends Controller
{
    protected $users;

    protected $organizations;

    public function __construct(UserRepositoryInterface $users,
        OrganizationRepositoryInterface $organizations)
    {
        $this->beforeFilter('auth');

        $this->users = $users;

        $this->organizations = $organizations;
    }

    /**
     * Display view of all current users
     *
     * @return Response
     */
    public function index()
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');

        if ($sortby && $order) 
        {
            $users = $this->users->findAllPaginatedSorted($sortby, $order);       
        }
        else
        {
            $users = $this->users->findAllPaginated();
        }

        return view('users/index', compact('users', 'sortby', 'order'));
    }

    /**
     * Display view for adding new user
     *
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AddUserFormRequest $request)
    {

        $job = new RegisterNewUser($request, Auth::user()->organization_id, Role::MODERATOR);

        $this->dispatch($job);

        Flash::overlay("New Moderator successfully added.");

        return redirect()->route('admin::users');

    }

    public function invite()
    {
        return view('users/invite');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return "Show User";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->users->findById($id);

        if ($user)
        {
            return view('users.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        try
        {

        }
        catch (ValidationException $e)
        {

        }
        \Auth::user()->update(Input::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user !== null)
        {
            $user->delete();
            Flash::success($user->getFullName() . ' successfully delete!');
            return redirect()->back();
        }

    }
}
