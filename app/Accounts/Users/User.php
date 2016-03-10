<?php namespace AllAccessRMS\Accounts\Users;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Validation\Validator;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use AllAccessRMS\Core\BaseModel;
use Kodeine\Acl\Traits\HasRole;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, HasRole;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_id', 'email', 'firstname', 'lastname', 'active', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected static $rules = array(
        'email'     =>  'required|email|unique:users',
        'password'  =>  'required|min:5'
    );

    public function organization()
    {
        return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization', 'organization_id');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setFirstnameAttribute($firstname)
    {
        $this->attributes['firstname'] = ucfirst($firstname);
    }

    public function setLastnameAttribute($lastname)
    {
        $this->attributes['lastname'] = ucfirst($lastname);
    }

    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getOrganizationName()
    {
        return $this->organization->name;
    }

    public function getActiveString()
    {
        if ($this->active)
            return 'Active';

        return 'Inactive';
    }

    public function getTempPassword()
    {
        return $this->temp_password;
    }

    public function isOwner()
    {
        return $this->is(Role::OWNER);
    }

    public function isAdmin()
    {
        return $this->is(Role::ADMIN);
    }

    /**
     * @return Organization
     */
    public function getParentOrganization()
    {
        if ( ! is_null($this->organization->parent) )
        {
            return $this->organization->parent->first();
        }

        return $this->organization;
    }

    public function isOwnerOfParentOrganization()
    {
        return boolval(is_null($this->organization->parent_id ) && $this->isOwner());
    }

    public function getUserRoles()
    {
        $res = "";
        $roles = $this->roles()->get();

        foreach ($roles as $role) {
            $res .= $role->name . ', ';
        }

        rtrim($res);
        rtrim($res, ',');

        return $res;
    }

}
