<?php namespace AllAccessRMS\Jobs;

use Exception;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

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
                    $this->request->input('organizationinfo.address'),
                    $this->request->input('organizationinfo.city'),
                    $this->request->input('organizationinfo.state'),
                    $this->request->input('organizationinfo.zipcode'),
                    $this->request->input('organizationinfo.telephone')
                );

        if ($user)
        {
            $job = new SendWelcomeEmailWithTempPassword($user);
            $this->dispatch($job);
        }
    }

    private function register($organizationName, $email, $firstname, $lastname, $address,
                              $city, $state, $zipcode, $telephone)
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
                $organizationAddress = new OrganizationInfo();
                $organizationAddress->address = $address;
                $organizationAddress->city = $city;
                $organizationAddress->state = $state;
                $organizationAddress->zipcode = $zipcode;
                $organizationAddress->telephone = $telephone;

                $organization->address()->save($organizationAddress);

                $user = $this->userRepo->make($userData);

                $user->temp_password = $userData['password'];

                if ($organization->users()->save($user)) {
                    $user->assignRole(Role::ADMIN);
                }

            }

        }
        catch (Exception $e) {

            if ( ! is_null($organization) )
            {
                $organization->delete();
            }
            abort(500);
        }

        return $user;
    }
}