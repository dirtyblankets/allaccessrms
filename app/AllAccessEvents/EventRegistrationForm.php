<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseModel;

class EventRegistrationForm extends BaseModel {

    protected $table = 'event_registration_forms';

    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo('AllAccessRMS\AllAccessEvents\Event')->withTimestamps();
    }
}