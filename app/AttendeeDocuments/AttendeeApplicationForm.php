<?php namespace AllAccessRMS\AttendeeDocuments;

use AllAccessRMS\Core\BaseModel;

class AttendeeApplicationForm extends BaseModel {

    protected $table = 'attendee_application_forms';

    protected $guarded = [];

    public function attendee()
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Attendee')->withTimestamps();
    }
}