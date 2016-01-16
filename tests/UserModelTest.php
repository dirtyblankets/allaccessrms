<?php

use App\Accounts\Users\User;
//use App\Accounts\Users\Role;
//use App\Accounts\Users\Permission;
use App\Accounts\Organizations\Organization;

class UserModelTest extends TestCase
{

    public function testInstance()
    {
        new User;
    }

    public function testEmailIsRequired()
    {
        $organization = Organization::find(1);

        $user = new User;
        $user->firstname = 'Kap';
        $user->lastname = 'Choi';
        $user->password = 'password';
        $user->organization()->associate($organization);

        $this->assertFalse($user->save());
        $user->delete();
    }

    public function testEmailMustBeUnique()
    {
        $organization = Organization::find(1);

        $user = new User;
        $user->firstname = 'Kap';
        $user->lastname = 'Choi';
        $user->password = 'password';
        $user->organization()->associate($organization);

        $this->assertFalse($user->save());
        $user->delete();
    }
    /*

    public function testUserActive()
    {
        $user = factory('App\AllAccessRMS\Accounts\Users\User')->make(['active'=>1]);
        $this->assertEquals($user->getActiveString(), 'Active');
        $user->delete();
    }

    public function testUserInactive()
    {
        $user = factory('App\Accounts\Users\User')->make(['active'=>0]);
        $this->assertEquals($user->getActiveString(), 'Inactive');
        $user->delete();
    }

    public function testUserOrganization()
    {
        $user = factory('App\Accounts\Users\User')->make(['active'=>1]);
        $this->assertEquals($user->organization->name, 'All Access');
        $user->delete();
    }
    */
}