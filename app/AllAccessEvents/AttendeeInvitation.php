<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseModel;

class AttendeeInvitation extends BaseModel {

    protected $table = 'attendee_invites';

    protected $fillable = [
        'event_id',
        'attendee_email',
        'attendee_name',
        'invite_code'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}