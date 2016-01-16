<?php namespace AllAccessRMS\Accounts\Organizations;

trait Relationship
{
    public function children()
    {
        return $this->hasMany('Organizations', 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('Organizations', 'parent_id');
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
}