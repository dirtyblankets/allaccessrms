<?php namespace AllAccessRMS\AttendeeDocuments;

use AllAccessRMS\Core\BaseModel;

class AttendeeApplicationForm extends BaseModel {

    protected $table = 'attendee_doc_app_forms';

    protected $guarded = [];

    public static $DOC_NAME = "Application Form";

    public function attendee_document()
    {
        return $this->belongsTo('AllAccessRMS\DocumentDefinitions\AttendeeDocument', 'attendee_document_id')->withTimestamps();
    }
}