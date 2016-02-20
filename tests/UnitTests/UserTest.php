<?php

use AllAccessRMS\Accounts\Users\User;
use AllAccessRMS\Accounts\Organizations\Organization;

class UserTest extends \TestCase
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

    public function testUserActive()
    {
        $user = factory('AllAccessRMS\Accounts\Users\User')
                    ->make([
                        'active'            =>  1,
                        'organization_id'   =>  1
                    ]);

        $this->assertEquals($user->getActiveString(), 'Active');
        $user->delete();
    }

    public function testUserInactive()
    {
        $user = factory('AllAccessRMS\Accounts\Users\User')
                    ->make(['active'=>0, 'organization_id'=>1]);

        $this->assertEquals($user->getActiveString(), 'Inactive');
        $user->delete();
    }

    public function testUserOrganization()
    {
        $user = factory('AllAccessRMS\Accounts\Users\User')
                    ->make(['active'=>1, 'organization_id'=>1]);
        $this->assertEquals($user->organization->name, 'All Access');
        $user->delete();
    }

    public function testSubUserParentOrganization()
    {
        $organization = factory('AllAccessRMS\Accounts\Organizations\Organization')
                            ->make(['parent_id' => 1]);

        $organization->save();

        $user = new User();
        $user->firstname = "Firstname";
        $user->lastname = "Lastname";
        $user->email = "test@test.com";

        $organization->users()->save($user);

        $parentOrganization = Organization::find(1);

        $user->getParentOrganization();
        $this->assertEquals($user->getParentOrganization()->id, $parentOrganization->id);

        $organization->delete();
    }

    public function testRootUserParentOrganization()
    {
        $user = User::find(1);
        $parentOrganization = Organization::find(1);

        $this->assertEquals($user->getParentOrganization()->id, $parentOrganization->id);
    }
}