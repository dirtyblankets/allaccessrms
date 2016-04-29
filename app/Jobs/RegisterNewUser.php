<?php namespace AllAccessRMS\Jobs;

use Hash;
use Exception;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\Accounts\Users\UserRepository;
use AllAccessRMS\Accounts\Users\Role;

use AllAccessRMS\Jobs\SendWelcomeEmail;

class RegisterNewUser extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    protected $userRepo;

    protected $organizationRepo;

    protected $organization_id;

    // The role to designate the user as.
    protected $roleType;

    public function __construct($request, $organization_id, $roleType)
    {
        $this->request = $request;
        $this->organization_id = $organization_id;
        $this->roleType = $roleType;

        $this->userRepo = new UserRepository();
        $this->organizationRepo = new OrganizationRepository();
    }

    public function handle()
    {
        $user_data = array(
            'organization_id'   =>  $this->organization_id,
            'email'     =>  $this->request->input('email'),
            'firstname' =>  $this->request->input('firstname'),
            'lastname'  =>  $this->request->input('lastname'),
            'telephone' =>  $this->request->input('telephone'),
            'active'    =>  1,
        );

        $user = $this->userRepo->create($user_data);

        $user->assignRole($this->roleType);

        if ($user)
        {
            $this->dispatch(new SendWelcomeEmail($user));
        }
    }
}