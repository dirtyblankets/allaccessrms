<?php namespace AllAccessRMS\DocumentDefinitions;

use AllAccessRMS\Core\BaseModel;

class ApplicationForm extends BaseModel {

    protected $table = 'application_forms';

    protected $guarded = [];

    public static $DOC_NAME = "APPLICATION_FORM";

    public function attendee_applications()
    {
        return $this->hasMany('AllAccessRMS\AttendeeDocuments\AttendeeApplication', 'application_form_id', 'id')->withTimestamps();
    }

    public function event()
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Event')->withTimestamps();
    }
}