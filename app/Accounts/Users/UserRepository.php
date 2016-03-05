<?php namespace AllAccessRMS\Accounts\Users;

use Session;
use AllAccessRMS\Core\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface {

    protected $organization_id;

    protected $auth_id;

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->organization_id = Session::get('tenant_id');
        $this->auth_id = Session::get('self_id');
    }

    public function findAllPaginatedSorted($sortby, $order, $perPage = 20)
    {
        return $this->model
                    ->where('id', '!=', 1)
                    ->where('id', '!=', $this->auth_id)
                    ->orderBy($sortby, $order)
                    ->paginate($perPage);
    }

    public function findAllPaginated($perPage = 20)
    {
        return $this->model
                    ->where('id', '!=', 1)
                    ->where('id', '!=', $this->auth_id)
                    ->orderBy('lastname')
                    ->paginate($perPage);
    }

    public function findByEmail($email)
    {

        return $this->model
                    ->where('id', '!=', 1)
                    ->where('organization_id', $this->organization_id)
                    ->where('email', '=', $email)
                    ->firstOrFail();
    }

    public function updateSettings(User $user, array $data)
    {
        // Add code here
    }
}