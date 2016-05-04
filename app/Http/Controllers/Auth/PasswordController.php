<?php namespace AllAccessRMS\Http\Controllers\Auth;

use Auth;
use Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Laracasts\Flash\Flash;

use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Http\Requests\PasswordChangeRequest;
use AllAccessRMS\Jobs\SetPassword;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function update(PasswordChangeRequest $request, $id)
    {
        $check = auth()->validate([
            'email'    => Auth::user()->email,
            'password' => $request->input('current_password'),
        ]);

        if (!$check)
        {
            return redirect()
                    ->back()
                    ->withErrors('Current Password is incorrect.');
        }

        $userId     = Auth::user()->id;
        $password   = $request->input('new_password');

        $job = new SetPassword($userId, $password);
        $this->dispatch($job);

        Flash::overlay('Password successfully changed!');
        return redirect()->back();

    }
}
