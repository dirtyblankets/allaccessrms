<?php namespace AllAccessRMS\Jobs;

use Log;
use Exception;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\Accounts\Organizations\OrganizationAddress;
use AllAccessRMS\Accounts\Users\User;
use AllAccessRMS\Accounts\Users\UserRepository;
use AllAccessRMS\Accounts\Users\Role;

class RegisterPartnerOrganization extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    protected $userRepo;

    protected $organizationRepo;

    public function __construct($request)
    {
        $this->request = $request;
        $this->userRepo = new UserRepository(new User());
        $this->organizationRepo = new OrganizationRepository(new Organization());
    }

    public function handle()
    {
        $user = $this->register(
                    $this->request->input('organizations.name'),
                    $this->request->input('users.email'),
                    $this->request->input('users.firstname'),
                    $this->request->input('users.lastname'),
                    $this->request->input('organizationaddress.address'),
                    $this->request->input('organizationaddress.city'),
                    $this->request->input('organizationaddress.state'),
                    $this->request->input('organizationaddress.zipcode')
                );

        if ($user)
        {
            $job = new SendWelcomeEmailWithTempPassword($user);
            $this->dispatch($job);
        }
    }

    private function register($organizationName, $email, $firstname, $lastname, $address,
                              $city, $state, $zipcode)
    {
        $user = null;

        $organization = null;

        try {

            $organizationData = array(
                'name'  =>  $organizationName
            );

            $userData = array(
                'email'     =>  $email,
                'firstname' =>  $firstname,
                'lastname'  =>  $lastname,
                'password'  =>  str_random(5)
            );

            $organization = $this->organizationRepo->createSubOrganization($organizationData);

            if ($organization)
            {
                $organizationAddress = new OrganizationAddress();
                $organizationAddress->address = $address;
                $organizationAddress->city = $city;
                $organizationAddress->state = $state;
                $organizationAddress->zipcode = $zipcode;

                $organization->address()->save($organizationAddress);

                $user = $this->userRepo->make($userData);

                $user->temp_password = $userData['password'];

                if ($organization->users()->save($user)) {
                    $user->assignRole(Role::OWNER);
                }

            }

        }
        catch (Exception $e) {

            if ( ! is_null($organization) )
            {
                $organization->delete();
            }
        }

        return $user;
    }
}