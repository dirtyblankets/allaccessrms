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
    use Authenticatable, CanResetPassword, HasRole, Relationship;

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
    protected $fillable = ['organization_id', 'email', 'firstname', 'lastname', 'active', 'password'];

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
}
