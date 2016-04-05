<?php namespace AllAccessRMS\Accounts\Users;

use Kodeine\Acl\Models\Eloquent\Role as KodeineRole;

class Role extends KodeineRole
{
    /**
     * @constant
     */
    const OWNER = 'owner';
    const ADMIN = 'admin';
    const MODERATOR = 'moderator';

    /*
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    */
}
