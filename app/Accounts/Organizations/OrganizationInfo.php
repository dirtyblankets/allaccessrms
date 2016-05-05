<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseModel;

class OrganizationInfo extends BaseModel
{
    protected $table = 'organization_info';

    protected $guarded = [];

    protected static $rules = array(
    );

    public function organization()
    {
    	return $this->belongsTo(Organization::class);
    }

    public function setCityAttribute($city)
    {
        $this->attributes['city'] = ucwords($city);
    }

}
