<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseRepository;
use AllAccessRMS\Accounts\Organizations\Organization;

class OrganizationRepository extends BaseRepository implements OrganizationRepositoryInterface {

    public function __construct()
    {
        $organization = new Organization();
        parent::__construct($organization);
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
                    ->where('id', '!=', $this->userOrganizationId)
                    ->orderBy('name')
                    ->paginate($perPage);
    }

    public function findAllPaginatedSorted($sortby, $order, $perPage = 20)
    {
        return $this->model
                    ->where('id', '!=', $this->userOrganizationId)
                    ->orderBy($sortby, $order)
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

    public function allTenantOrganizations($id)
    {
        return $this->model
                    ->where('parent_id', $id)
                    ->orWhere('id', $id)
                    ->get();
    }
}