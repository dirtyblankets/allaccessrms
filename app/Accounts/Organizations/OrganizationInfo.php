<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseModel;

class OrganizationInfo extends BaseModel
{
    protected $table = 'organization_info';

    protected $guarded = [];

    protected $appends = ['telephone_formatted'];

    protected static $rules = array();

    public function organization()
    {
    	return $this->belongsTo(Organization::class);
    }

    public function setCityAttribute($city)
    {
        $this->attributes['city'] = ucwords($city);
    }

    public function getTelephoneFormattedAttribute()
    {
        $telephone_formatted = $this->attributes['telephone'];

        if (!empty($telephone_formatted))
        {
            return "(".substr($telephone_formatted, 0, 3).") ".substr($telephone_formatted, 3, 3)."-".substr($telephone_formatted,6);
        }
        else
        {
            return null;
        }

    }

}
