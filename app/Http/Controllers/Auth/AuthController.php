<?php namespace AllAccessRMS\Http\Controllers\Auth;

use Auth;
use Validator;
use AllAccessRMS\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Laracasts\Flash\Flash;

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
            Flash::overlay("Incorrect Login!");
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(\Input::except('password'));
        }
        else
        {
            $email = \Input::get('email');
            $password = \Input::get('password');

            if (Auth::attempt(array('email' => $email, 'password' => $password, 'active' => 1), true))
            {
                session(array(  'organization_id' =>  Auth::user()->organization_id,
                                'self_id'   =>  Auth::user()->id));
                if (Auth::user()->is('owner'))
                {
                    return redirect()->route('owner::' . $this->redirectPath);
                }

                return redirect()->back();
            }
            
            return redirect()
                ->back()
                ->withInput(\Input::except('password'))
                ->withErrors('Invalid Credentials!');
        }

    }

    public function getLogout()
    {
        Auth::logout();
        \Session::flush();
        return redirect($this->loginPath);
    }

}
