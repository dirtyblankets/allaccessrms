<?php namespace AllAccessRMS\Jobs;

use Log;
use Exception;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use App\AllAccessRMS\Accounts\Users\User;

class SendWelcomeEmailWithTempPassword extends Job implements SelfHandling
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(Mailer $mail)
    {
        try {
        } catch (Exception $e) {

        }
    }

}