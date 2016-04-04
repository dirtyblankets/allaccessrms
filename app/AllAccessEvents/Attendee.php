<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseModel;
use Laravel\Cashier\Billable;

class Attendee extends BaseModel
{
    use Billable;

    protected $table = 'attendees';

    protected $guarded = [];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organization()
    {
        return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization');
    }

    public function applicationforms()
    {
        return $this->hasMany('AllAccessRMS\Documents\ApplicationForm');
    }

    public function healthforms()
    {
        return $this->hasMany('AllAccessRMS\Documents\HealthForm');
    }
}