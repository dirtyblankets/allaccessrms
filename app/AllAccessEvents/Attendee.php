<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseModel;

use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class Attendee extends BaseModel implements BillableContract
{
    use Billable;

    protected $table = 'attendees';

    protected $guarded= [];

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

    public function setBirthdateAttribute($birthdate)
    {
        $this->attributes['birthdate'] = Carbon::parse($birthdate);
    }

    public function getBirthdateAttribute()
    {
        if ($this->attributes['birthdate'] != '0000-00-00')
        {
            return Carbon::parse($this->attributes['birthdate'])->format('m/d/Y');
        }
    }

    public function setTrialEndsAtAttribute($trial_ends_at)
    {
        $this->attributes['trial_ends_at'] = Carbon::parse($trial_ends_at);
    }

    public function getTrialEndsAtAttribute()
    {
        if ($this->attributes['trial_ends_at'] != '0000-00-00')
        {
            return Carbon::parse($this->attributes['trial_ends_at'])->format('m/d/Y');
        }
    }

    public function setSubscriptionEndsAtAttribute($subscription_ends_at)
    {
        $this->attributes['subscription_ends_at'] = Carbon::parse($subscription_ends_at);
    }

    public function getSubscriptionEndsAtAttribute()
    {
        if ($this->attributes['subscription_ends_at'] != '0000-00-00')
        {
            return Carbon::parse($this->attributes['subscription_ends_at'])->format('m/d/Y');
        }
    }
}