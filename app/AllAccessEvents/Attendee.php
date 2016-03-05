<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseModel;

/**
 * AllAccessRMS\AllAccessEvents\Attendee
 *
 * @property integer $id
 * @property integer $organization_id
 * @property integer $event_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $registration_date
 * @property float $amount_paid
 * @property float $total_amount
 * @property string $phone_number
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \AllAccessRMS\AllAccessEvents\Event $events
 * @property-read \AllAccessRMS\Accounts\Organizations\Organization $organizations
 */
class Attendee extends BaseModel
{
    protected $table = 'attendees';

    protected $fillable = [
        'event_id',
        'organization_id',
        'firstname',
        'lastname',
        'email',
        'registration_date',
        'amount_paid',
        'total_amount',
        'phone_number'
    ];
    public function events()
    {
        return $this->belongsTo(Event::class);
    }

    public function organizations()
    {
        return $this->belongsTo('AllAccessRMS\Accounts\Organizations\Organization');
    }
}