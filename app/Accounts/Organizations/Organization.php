<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseModel;

class Organization extends BaseModel
{
	protected $table = 'organizations';

	protected $fillable = ['parent_id', 'name'];

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
        return $this->hasMany('AllAccessRMS\AllAccessEvents\Event');
    }

    public function users()
    {
        return $this->hasMany('AllAccessRMS\Accounts\Users\User');
    }

    public function info()
    {
        return $this->hasOne(OrganizationInfo::class);
    }

    
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }
    

    public function isChild()
    {
        return (! is_null($this->parent_id));
    }

}