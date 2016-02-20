<?php namespace AllAccessRMS\Accounts\Organizations;

use AllAccessRMS\Core\BaseModel;

/**
 * AllAccessRMS\Accounts\Organizations\OrganizationInfo
 *
 * @property integer $id
 * @property integer $organization_id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $country
 * @property string $telephone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \AllAccessRMS\Accounts\Organizations\Organization $organization
 */
class OrganizationInfo extends BaseModel
{
    protected $table = 'organization_info';

    protected $fillable = ['address', 'city', 'state', 'zipcode', 'country', 'telephone'];

    protected static $rules = array(
        'address'  =>  'unique:organization_info'
    );

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
        if (!is_null($telephone))
        {
            return phone_format($telephone, 'US');
        }

        return "";
    }
}
