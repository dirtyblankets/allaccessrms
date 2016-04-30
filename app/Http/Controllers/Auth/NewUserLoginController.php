<?php namespace AllAccessRMS\Http\Controllers\Auth;

use Auth;
use Session;
use Validator;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use AllAccessRMS\Accounts\Users\UserRepositoryInterface;

use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Http\Requests\FirstTimeLoginFormRequest;
use AllAccessRMS\Jobs\SetPassword;

class NewUserLoginController extends Controller
{

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = 'dashboard';

    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->users = $users;
    }

    public function getLogin($user_id)
    {
        $user = $this->users->findById($user_id);

        return view('auth/new_login', compact('user'));
    }


    public function postLogin(FirstTimeLoginFormRequest $request)
    {
        $email      = $request->input('email');
        $userId     = $request->input('user_id');
        $password   = $request->input('password');

        $job = new SetPassword($userId, $password);
        $this->dispatch($job);

        if (Auth::attempt(array('email' => $email, 
                                'password' => $password, 
                                'active' => 1), true))
        {
           $parentOrg = Auth::user()->organization->parent; 

            if ( ! is_null($parentOrg)) 
            {
                $parentOrgId = $parentOrg->id; 
            } 
            else 
            {
                $parentOrgId = null;
            }

            session(array(  'USER_ID'                   =>  Auth::user()->id,
                            'USER_ORGANIZATION_ID'      =>  Auth::user()->organization_id,
                            'USER_PARENT_ORGANIZATION'  =>  $parentOrgId));

            if (Auth::user()->is('admin|moderator'))
            {
                return redirect()->route($this->redirectPath);
            }

            return redirect()->back();
        }
    }

}
