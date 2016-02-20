<?php namespace AllAccessRMS\AllAccessEvents;

use Exception;
use Carbon\Carbon;
use AllAccessRMS\Core\BaseModel;

class EventSite extends BaseModel
{
	protected $table = 'eventsites';

	protected $fillable = [	'name', 'address', 'city', 'state',
							'zipcode', 'country', 'price'];

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}