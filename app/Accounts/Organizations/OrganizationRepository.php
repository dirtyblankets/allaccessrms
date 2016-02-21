<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseRepository;
use AllAccessRMS\Accounts\Organizations\Organization;

class OrganizationRepository extends BaseRepository implements OrganizationRepositoryInterface {

    private $id;

    public function __construct(Organization $organization)
    {
        $this->model = $organization;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createSubOrganization(array $attributes = [])
    {
        $parentOrganization = $this->findRootOrganization();

        $newOrganization = $this->make($attributes);
        $newOrganization->parent_id = $parentOrganization->id;
        $newOrganization->save();

        return $newOrganization;
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function findAllPaginated($perPage = 20)
    {
        return $this->model
                    ->orderBy('name')
                    ->paginate($perPage);
    }

    /**
     * @param $name
     * @return collection
     */
    public function findByName($name)
    {
        return $this->model
                    ->where('name', '=', $name)
                    ->get();
    }

    /**
     * @return root Organization
     */
    public function findRootOrganization()
    {
        return $this->model->where('parent_id', '=', NULL)->first();
    }

    public function getPartnerOrganizations($parent_id)
    {
        return $this->model
                    ->where('parent_id', '=', $parent_id)
                    ->get();
    }
}