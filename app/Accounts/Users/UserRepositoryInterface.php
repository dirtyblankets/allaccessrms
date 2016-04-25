<?php namespace AllAccessRMS\Accounts\Users;

use AllAccessRMS\Accounts\Users\User;
use AllAccessRMS\Core\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
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