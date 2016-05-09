<?php namespace AllAccessRMS\AllAccessEvents;

use Exception;
use Carbon\Carbon;
use AllAccessRMS\Core\BaseModel;
use AllAccessRMS\Core\BaseDateTime;

class Event extends BaseModel {
	
	protected $table = 'events';

    protected $appends = ['has_ended', 'thumbnail_url', 'price_cents'];

    protected $guarded = [];

    public $banner_img_prefix = "img_";

    public $banner_thumbnail_prefix = "thumbnail_";

	public function attendees()
	{
		return $this->hasMany(Attendee::class);
	}

	public function organization()
	{
		return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization');
	}

	public function partners()
    {
        return $this->belongsToMany('AllAccessRMS\Accounts\Organizations\PartnerOrganization')
					->whereNotNull('parent_id');
    }

	public function eventsite()
	{
		return $this->hasOne(EventSite::class);
	}

	public function guests()
	{
		return $this->hasMany(AttendeeInvitation::class);
	}

	public function registration_form()
	{
		return $this->hasOne('AllAccessRMS\AllAccessEvents\EventRegistrationForm');
	}

	public function eventDescriptionShort()
	{
		$short = substr($this->attributes['description'], 0, 30) . "...";

		return $short;
	}

	// Convert price (decimal value) to cents
	public function setPriceAttribute($price)
	{
		$this->attributes['price'] = bcmul($price, 100);
	}

	// Convert cents back to dollars and cents
	public function getPriceAttribute()
	{
		return bcdiv($this->attributes['price'], 100, 2);
	}

	public function getPriceCentsAttribute()
	{
		return $this->attributes['price'];
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
		if ($this->attributes['start_date'] != '0000-00-00')
		{
			return Carbon::parse($this->attributes['start_date'])->format('m/d/Y');
		}
	}

	public function getEndDateAttribute()
	{
		if ($this->attributes['end_date'] != '0000-00-00')
		{
			return Carbon::parse($this->attributes['end_date'])->format('m/d/Y');
		}		
	}

	public function getPublishedAttribute()
	{
		return boolval($this->attributes['published']);
	}

	public function eventStatus()
	{
		if ($this->getPublishedAttribute())
		{
			return "Published";
		}
		else
		{
			return "Not yet live";
		}
	}


    public function getHasEndedAttribute()
    {
        return Carbon::parse($this->attributes['end_date']) <= BaseDateTime::now();
    }

    public function getThumbnailUrlAttribute()
    {
    	$img_url = $this->attributes['img_url'];

    	if (!empty($img_url))
    	{
    		return str_replace($this->banner_img_prefix, $this->banner_thumbnail_prefix, $this->attributes['img_url']);
    	}

    	return null;
    }

    public function getPrivateAttribute()
    {
    	return boolval($this->attributes['private']);
    }

    public function eventType()
    {
    	if ($this->getPrivateAttribute())
    	{
    		return "Private";
    	}
    	else
    	{
    		return "Public";
    	}
    }
}