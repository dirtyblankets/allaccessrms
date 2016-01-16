<?php namespace AllAccessRMS\Accounts\Users;

use AllAccessRMS\Accounts\Users\User;

interface UserRepositoryInterface {
    /**
     * Find all users paginated.
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\Paginator|\User[]
     */
    public function findAllPaginated($perPage = 20);

    /**
     * Find a user by it's email.
     *
     * @param string $email
     * @return \AllAccessRMS\Models\User
     */
    public function findByEmail($email);

    /**
     * Update the user's settings.
     *
     * @param array $data
     * @return \AllAccessRMS\Models\User
     */
    public function updateSettings(User $user, array $data);

}