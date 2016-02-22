<?php namespace AllAccessRMS\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Bus\SelfHandling;

use AllAccessRMS\Accounts\Users\User;

class SendWelcomeEmailWithTempPassword extends Job implements SelfHandling
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(Mailer $mailer)
    {
        $parent_organization = $this->user->getParentOrganization();

        $user_data = array (
            'name' => $this->user->getFullName(),
            'parent_organization' => $parent_organization->name,
            'password'  =>  $this->user->temp_password
        );

        $mailer->send('emails.newuserwelcome', ['user' => $user_data], function ($m) {
            $m->from('administrator@allaccess.dev', 'All Access RMS');
            $m->to('kapchoi@yahoo.com')->subject('Welcome to AllAccessRMS!');
        });

    }

}