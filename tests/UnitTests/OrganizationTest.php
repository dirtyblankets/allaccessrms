<?php

use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\OrganizationInfo;

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

        $parent_organization->children()->delete();
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
}