<?php namespace AllAccessRMS\Accounts\Organizations;

class PartnerOrganization extends Organization
{
    public function events()
    {
        return $this->belongToMany('AllAccessRMS\AllAccessEvents\Event')->withTimestamps();
    }

}