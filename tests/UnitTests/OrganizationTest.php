<?php

use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\PartnerOrganization;
use AllAccessRMS\Accounts\Organizations\OrganizationInfo;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;

class OrganizationTest extends \TestCase
{

    public function testOrganizationInstance()
    {
        new Organization();
    }

    public function testOrganizationInfoInstance()
    {
        new OrganizationInfo();
    }

    public function testChildrenOrganizationIsAdded()
    {
        $parent_organization = Organization::find(1);

        $child_organization = new Organization();
        $child_organization->name = 'Children Organization A';
        $parent_organization->children()->save($child_organization);

        $child_organization = new Organization();
        $child_organization->name = 'Children Organization B';
        $parent_organization->children()->save($child_organization);

        $children = $parent_organization->children()->get();
        $children = $children->keyBy('name');

        $this->assertTrue($children->has('Children Organization A'));
        $this->assertTrue($children->has('Children Organization B'));

        $orgToDelete = Organization::where('name', 'Children Organization A')->first();
        $orgToDelete->delete();

        $orgToDelete = Organization::where('name', 'Children Organization B')->first();
        $orgToDelete->delete();
    }

    public function testIsChildOrganization()
    {
        $parent_organization = Organization::find(1);

        $this->assertFalse($parent_organization->isChild());

        $child_organization = new Organization();
        $child_organization->name = 'Children Organization A';
        $parent_organization->children()->save($child_organization);

        $this->assertTrue($child_organization->isChild());
        $child_organization->delete();

    }

    public function testGetPartnerOrganizations()
    {
        $org = new Organization();
        $orgRepo = new OrganizationRepository($org);

        $partners = $orgRepo->getPartnerOrganizations(1);
        $partners = $partners->keyBy('name');

        $this->assertTrue($partners->has('Partner 1'));
        $this->assertFalse($partners->has('Fake'));
    }

    public function testPartnerOrganization()
    {
        $org = PartnerOrganization::find(2);
    }
}