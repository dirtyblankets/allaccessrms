<?php namespace AllAccessRMS\AttendeeDocuments;

use AllAccessRMS\Core\BaseModel;

class AttendeeHealthReleaseForm extends BaseModel 
{

    protected $table = 'attendee_health_release_forms';

    protected $guarded = [];

    public function attendee()
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Attendee')->withTimestamps();
    }
}