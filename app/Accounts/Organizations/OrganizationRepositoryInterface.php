<?php namespace AllAccessRMS\Accounts\Organizations;

interface OrganizationRepositoryInterface
{
    /**
     * @return mixed
     */
    public function createSubOrganization(array $attributes = []);
    /**
     * Find all organizations paginated.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\Paginator|\Organization[]
     */
    public function findAllPaginated($perPage = 20);

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name);

}