<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseModel;

class Event extends BaseModel {
	
	protected $table = 'events';

	protected $fillable = ['title', 'description', 'start_time', 'end_time',
	'start_date', 'end_date', 'contact_phone', 'price', 'capacity', 'status'];

	public function attendee()
	{
		return $this->hasMany(Attendee::class);
	}

	public function organization()
	{
		return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization');
	}
}