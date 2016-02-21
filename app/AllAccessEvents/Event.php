<?php namespace AllAccessRMS\AllAccessEvents;

use Exception;
use Carbon\Carbon;
use AllAccessRMS\Core\BaseModel;

/**
 * AllAccessRMS\AllAccessEvents\Event
 *
 * @property integer $id
 * @property integer $organization_id
 * @property string $title
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property string $start_time
 * @property string $end_time
 * @property string $contact_phone
 * @property float $price
 * @property integer $capacity
 * @property boolean $published
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AllAccessRMS\AllAccessEvents\Attendee[] $attendee
 * @property-read \AllAccessRMS\Accounts\Organizations\Organization $organization
 */
class Event extends BaseModel {
	
	protected $table = 'events';

	protected $fillable = [	'title', 'description', 'start_time', 'end_time',
							'start_date', 'end_date', 'contact_phone', 'price', 
							'capacity', 'published', 'private'];

	public function attendee()
	{
		return $this->hasMany(Attendee::class);
	}

	public function organization()
	{
		return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization');
	}

	public function partners()
    {
        return $this->belongsToMany('AllAccessRMS\Accounts\Organizations\PartnerOrganization')->withTimestamps();
    }

	public function eventsite()
	{
		return $this->hasOne(EventSite::class);
	}

	public function setStartTimeAttribute($start_time)
	{
		$this->attributes['start_time'] = date("H:i:s", strtotime($start_time));
	}

	public function getStartTimeAttribute()
	{
		return date("h:i A", strtotime($this->attributes['start_time']));
	}

	public function setEndTimeAttribute($end_time)
	{
        $this->attributes['end_time'] = date("H:i:s", strtotime($end_time));
	}

	public function getEndTimeAttribute()
	{
		return date("h:i A", strtotime($this->attributes['end_time']));
	}
	
	public function setStartDateAttribute($start_date)
	{
		$this->attributes['start_date'] = Carbon::parse($start_date);
	}

	public function setEndDateAttribute($end_date)
	{
		$this->attributes['end_date'] = Carbon::parse($end_date);
	}

	public function getStartDateAttribute()
	{
		try
		{
			if ($this->attributes['start_date'] != '0000-00-00')
			{
				return Carbon::parse($this->attributes['start_date'])->format('m/d/Y');
			}
		}
		catch (Exception $e)
		{
		}
	}

	public function getEndDateAttribute()
	{
		try
		{
			if ($this->attributes['end_date'] != '0000-00-00')
			{
				return Carbon::parse($this->attributes['end_date'])->format('m/d/Y');
			}
		}
		catch (Exception $e)
		{
		}
	}

	public function getPublishedAttribute()
	{
		return boolval($this->attributes['published']);
	}

}