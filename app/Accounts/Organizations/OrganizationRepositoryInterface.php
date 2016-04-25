<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseRepositoryInterface;

interface OrganizationRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function createSubOrganization(array $attributes = []);

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name);

}