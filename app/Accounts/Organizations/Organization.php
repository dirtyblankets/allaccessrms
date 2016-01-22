<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseModel;

class Organization extends BaseModel
{
	protected $table = 'organizations';

	protected $fillable = ['name'];

    protected static $rules = array(
        'name'  =>  'required'
    );

    public function children()
    {
        return $this->hasMany(Organization::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Organization::class, 'parent_id');
    }

    public function events()
    {
        return $this->hasMany('AllAccessRMS\EventRegistrations\Event');
    }

    public function users()
    {
        return $this->hasMany('AllAccessRMS\Accounts\Users\User');
    }

    public function address()
    {
        return $this->hasOne('AllAccessRMS\Accounts\Organizations\OrganizationAddress');
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }
    /*
    public function ownersEmail()
    {
        return $this->users();
    }
    */

}