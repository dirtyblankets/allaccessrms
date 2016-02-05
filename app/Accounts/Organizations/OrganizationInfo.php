<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseModel;

class OrganizationInfo extends BaseModel
{
    protected $table = 'organization_info';

    protected $fillable = ['address', 'city', 'state', 'zipcode', 'country', 'telephone'];

    public function organization()
    {
    	return $this->belongsTo(Organization::class);
    }

    public function setCityAttribute($city)
    {
        $this->attributes['city'] = ucwords($city);
    }

    public function getTelephoneAttribute($telephone)
    {
        return phone_format($telephone, 'US');
    }
}
