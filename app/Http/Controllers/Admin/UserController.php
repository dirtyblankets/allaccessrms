<?php namespace AllAccessRMS\Http\Controllers\Admin;

use Exception;
use Laracasts\Flash;
use Illuminate\Http\Request;
use Log;

use AllAccessRMS\Accounts\Users\Role;
use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Http\Controllers\Auth;
use AllAccessRMS\Accounts\Users\UserRepositoryInterface;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->beforeFilter('auth');

        $this->users = $users;
    }

    /**
     * Display view of all current users
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->users->findAllPaginated();
        return view('users/index', compact('users'));
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
    public function store(Request $request)
    {
        try
        {
            $firstname = \Input::get('firstname');
            $lastname = \Input::get('lastname');
            $password = \Hash::make('password');
            $email = \Input::get('email');

            // Save new user
            try {
                $newUser = $this->users->insert(array(  'firstname'=>$firstname,
                                                        'lastname'=>$lastname,
                                                        'email'=>$email,
                                                        'password'=>$password,));

                $newUser->assignRole(Role::MODERATOR);
                return redirect()->back()->with('success', 'User: ' . $newUser->getFullName() . ' successfully added.');

            } catch (Exception $e) {
                Log::error($e->getMessage());
            }

        }
        catch (ValidationException $e)
        {
            return redirect()
                ->back()
                ->withInput(\Input::except('password'))
                ->withErrors($e->getErrors());
        }
        catch (Exception $e){
            Log::error($e->getMessage());
        }
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
        $user = User::find($id);
        if ($user !== null)
        {
            return \View::make('users.edit', compact('user'));
        }
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
            \Flash::success($user->getFullName() . ' successfully delete!');
            return redirect()->back();
        }

    }
}
