<?php namespace AllAccessRMS\DocumentDefinitions;

use AllAccessRMS\Core\BaseModel;

class DocumentDefinition extends BaseModel 
{

    protected $table = 'document_definitions';

    protected $guarded = [];

    public function attendee_documents() 
    {
        return $this->hasMany(AttendeeDocument::class, 'doc_def_id')->withTimestamps();
    }

    public function organization()
    {
        return $this->belongsTo('AllAccessRMS\Accounts\Organization')->withTimestamps();
    }
}