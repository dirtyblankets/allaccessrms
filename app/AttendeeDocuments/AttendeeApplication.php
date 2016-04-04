<?php namespace AllAccessRMS\AttendeeDocuments;

use AllAccessRMS\Core\BaseModel;

class AttendeeApplication extends BaseModel {

    protected $table = 'attendee_app_form';

    protected $guarded = [
    ];

    public function attendee()
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Attendee', 'id', 'attendee_id')->withTimestamps();
    }

    public function applicationform()
    {
        return $this->belongsTo('AllAccessRMS\DocumentDefinitions\ApplicationForm', 'id', 'application_form_id');
    }
}