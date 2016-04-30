<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Accounts\Organizations\Organization;

class PartnerOrganization extends Organization
{
    public function events()
    {
        return $this->belongsToMany('AllAccessRMS\AllAccessEvents\Event')
        			->withPivot('event_id', 'partner_organization_id');
    }

}