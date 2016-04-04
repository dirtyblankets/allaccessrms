<?php namespace AllAccessRMS\AttendeeDocuments;

use AllAccessRMS\Core\BaseModel;

class AttendeeHealthForm extends BaseModel {

    protected $table = 'attendee_health_form';

    protected $guarded = [
    ];

    public function attendee()
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Attendee', 'id', 'attendee_id')->withTimestamps();
    }

    public function healthform()
    {
        return $this->belongsTo('AllAccessRMS\DocumentDefinitions\HealthAndReleaseForm', 'id', 'health_form_id');
    }
}