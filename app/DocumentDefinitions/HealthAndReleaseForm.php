<?php namespace AllAccessRMS\DocumentDefinitions;

use AllAccessRMS\Core\BaseModel;

class HealthAndReleaseForm extends BaseModel {

    protected $table = 'health_forms';

    protected $guarded = [];

    public function attendee_healthforms()
    {
        return $this->hasMany('AllAccessRMS\AttendeeDocuments\AttendeeHealthForm', 'health_form_id', 'id')->withTimestamps();
    }

    public function event()
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Event')->withTimestamps();
    }
}