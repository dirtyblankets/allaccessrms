<?php namespace AllAccessRMS\EventRegistrations;

use AllAccessRMS\Core\BaseModel;

class Attendee extends BaseModel
{
    protected $table = 'attendees';

    protected $fillables = ['firstname', 'lastname', 'email', 'registration_date',
                            'amount_paid', 'total_amount', 'phone_number'];
    public function events()
    {
        return $this->belongsTo('AllAccessRMS\EventRegistrations\Event');
    }

    public function organizations()
    {
        return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization');
    }
}