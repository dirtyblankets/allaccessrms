<?php namespace AllAccessRMS\Accounts\Users;

use Session;
use AllAccessRMS\Core\BaseRepository;
use AllAccessRMS\Accounts\Users\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface {


    public function __construct()
    {
        $user = new User();
        parent::__construct($user);
    }

    public function findAllPaginatedSorted($sortby, $order, $perPage = 20)
    {
        return $this->model
                    ->where('id', '!=', 1)
                    ->where('id', '!=', $this->userId)
                    ->orderBy($sortby, $order)
                    ->paginate($perPage);
    }

    public function findAllPaginated($perPage = 20)
    {
 
        return $this->model
                    ->where('id', '!=', 1)
                    ->where('id', '!=', $this->userId)
                    ->orderBy('lastname')
                    ->paginate($perPage);
    }

    public function findByEmail($email)
    {

        return $this->model
                    ->where('id', '!=', 1)
                    ->where('organization_id', $this->userOrganizationId)
                    ->where('email', '=', $email)
                    ->firstOrFail();
    }

    public function updateSettings(User $user, array $data)
    {
        // Add code here
    }
}