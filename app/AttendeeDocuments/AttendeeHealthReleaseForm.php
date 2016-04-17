<?php namespace AllAccessRMS\AttendeeDocuments;

use AllAccessRMS\Core\BaseModel;

class AttendeeHealthReleaseForm extends BaseModel {

    protected $table = 'attendee_doc_health_release_forms';

    protected $guarded = [];

    public static $DOC_NAME = "Health and Release Form";

    public function attendee_document()
    {
        return $this->belongsTo('AllAccessRMS\DocumentDefinitions\AttendeeDocument', 'attendee_document_id')->withTimestamps();
    }
}