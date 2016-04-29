<?php namespace AllAccessRMS\Http\Controllers\Auth;

use Auth;
use Session;
use Validator;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Http\Requests\FirstTimeLoginFormRequest;

class NewUserLoginController extends Controller
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


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin($user_id)
    {
        dd("test" . $user_id);
    }


    public function postLogin(FirstTimeLoginFormRequest $request)
    {

    }

}
