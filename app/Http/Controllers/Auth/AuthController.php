<?php namespace AllAccessRMS\Http\Controllers\Auth;

use Auth;
use Session;
use Validator;

use Illuminate\Support\Facades\Input;
use AllAccessRMS\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = 'dashboard';
    
    protected $loginPath = '/';
    
    private $loginRule = array(
            'email' => 'required|email|max:100',
            'password' => 'required|min:5'
    );

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }


    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), $this->loginRule);

        if ($validator->fails())
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }
        else
        {
            $email =  $request->input('email');
            $password = $request->input('password');

            if (Auth::attempt(array('email' => $email, 'password' => $password, 'active' => 1), true))
            {
                $parentOrg = Auth::user()->organization()->first()->parent()->first();

                if (!empty($parentOrg)) 
                {
                    $parentOrgId = $parentOrg->id; 
                } 
                else 
                {
                    $parentOrgId = null;
                }

                session(array(  
                    'USER_ID'   =>  Auth::user()->id,
                    'USER_ORGANIZATION_ID'  =>  Auth::user()->organization_id,
                    'USER_PARENT_ORGANIZATION'   =>  $parentOrgId 
                ));

                if (Auth::user()->is('owner|admin|moderator'))
                {
                    return redirect()->route($this->redirectPath);
                }

                return redirect()->route('logout');
            }
            
            return redirect()
                ->back()
                ->withInput($request->except('password'))
                ->withErrors('Invalid Credentials!');
        }

    }

    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect($this->loginPath);
    }

}
