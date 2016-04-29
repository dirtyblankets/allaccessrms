<?php namespace AllAccessRMS\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Bus\SelfHandling;

use AllAccessRMS\Accounts\Users\User;

class SendWelcomeEmail extends Job implements SelfHandling
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(Mailer $mailer)
    {
        $organization = $this->user->organization()->first();

        $user_data = array (
            'name' => $this->user->getFullName(),
            'organization' => $organization->name,
            'link'  =>  'https://allaccessrms.dev/new_user/' . $this->user->id,
        );

        $mailer->send('emails.newuserwelcome', $user_data, function ($m) {

            $m->from('administrator@allaccess.dev', 'All Access RMS');
            
            $m->to('kapchoi@yahoo.com')->subject('Welcome to AllAccessRMS!');
        });

    }

}