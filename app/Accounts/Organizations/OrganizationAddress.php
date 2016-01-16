<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseModel;

class OrganizationAddress extends BaseModel
{
    protected $table = 'organization_address';

    protected $fillable = ['address', 'city', 'state', 'zipcode', 'country'];

    public function organization()
    {
    	return $this->belongsTo(Organization::class);
    }

}
