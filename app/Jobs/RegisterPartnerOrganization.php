<?php namespace AllAccessRMS\Jobs;

use Log;
use Exception;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Jobs\Job;
use AllAccessRMS\Jobs\SendWelcomeEmail;

use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\Accounts\Organizations\OrganizationInfo;
use AllAccessRMS\Accounts\Users\User;
use AllAccessRMS\Accounts\Users\UserRepository;
use AllAccessRMS\Accounts\Users\Role;

class RegisterPartnerOrganization extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $user = $this->register($this->request);

        if ($user)
        {
            $this->dispatch(new SendWelcomeEmail($user));
        }

        return false;
    }

    private function register($request)
    {
        $userRepository = new UserRepository();

        $organizationRepository = new OrganizationRepository();

        try {

            $organizationData = array(
                'name'  =>  $request->input('organization.name'),
            );

            $userData = array(
                'email'     =>  $request->input('user.email'),
                'firstname' =>  $request->input('user.firstname'),
                'lastname'  =>  $request->input('user.lastname')
            );

            $organization = $organizationRepository->createSubOrganization($organizationData);

            if ($organization)
            {
                $organizationAddress = new OrganizationInfo();
                $organizationAddress->email =  $request->input('organizationinfo.email');
                $organizationAddress->address = $request->input('organizationinfo.address');
                $organizationAddress->city = $request->input('organizationinfo.city');
                $organizationAddress->state = $request->input('state');
                $organizationAddress->zipcode = $request->input('organizationinfo.zipcode');
                $organizationAddress->telephone = $request->input('organizationinfo.telephone');

                $organization->info()->save($organizationAddress);

                $user = $userRepository->make($userData);


                if ($organization->users()->save($user)) 
                {
                    $user->assignRole(Role::ADMIN);
                }

            }

        }
        catch (Exception $e) {

            if ( ! is_null($organization) )
            {
                $organization->delete();
            }
            Log::error($e->getMessage());
            abort(500);
        }

        return $user;
    }
}