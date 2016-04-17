<?php namespace AllAccessRMS\DocumentDefinitions;

use AllAccessRMS\Core\BaseModel;

class AttendeeDocument extends BaseModel {

    protected $table = 'attendee_documents';

    protected $guarded = [];

    public function attendee() 
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Attendee', 'attendee_id')->withTimestamps();
    }

    public function document_definition()
    {
    	return $this->belongsTo(DocumentDefinition::class);
    }

    public function event()
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Event', 'event_id');
    }
}