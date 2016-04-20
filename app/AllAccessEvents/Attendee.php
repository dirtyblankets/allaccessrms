<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseModel;

use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class Attendee extends BaseModel implements BillableContract
{
    use Billable;

    protected $table = 'attendees';

    protected $guarded = [];
    
    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organization()
    {
        return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization');
    }

    public function application_form()
    {
        return $this->hasOne('AllAccessRMS\AttendeeDocuments\AttendeeApplicationForm');
    }

    public function health_release_form()
    {
        return $this->hasOne('AllAccessRMS\AttendeeDocuments\AttendeeHealthReleaseForm');
    }
}