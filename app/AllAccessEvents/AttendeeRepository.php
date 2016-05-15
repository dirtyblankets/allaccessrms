<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;

use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;

class AttendeeRepository extends BaseRepository implements AttendeeRepositoryInterface 
{

	public function __construct()
    {
        $attendee = new Attendee();
        parent::__construct($attendee);
    }

    public function findByEventAndAttendeeId($eventId, $id)
    {
        return $this->model
                    ->where('event_id', $eventId)
                    ->where('id', $id)
                    ->first();
    }

    public function findByEventAndEmail($eventId, $email)
    {
        return $this->model
                    ->where('event_id', $eventId)
                    ->where('email', $email)
                    ->first();
    }

   /**
     * @param int $perPage
     * @return mixed
     */
    public function findAllPaginatedByEvent($eventId , $sortBy, $orderBy, $perPage = 20)
    {

        return $this->model
                    ->where('event_id', $eventId)
                    ->orderBy($sortBy, $orderBy)
                    ->paginate($perPage);  
    }

    public function findAllThatPaid($eventId , $sortBy, $orderBy, $perPage = 20)
    {

        $event_price = Event::find($eventId)->price;

        return $this->model
                    ->where('event_id', $eventId)
                    ->where('amount_paid', '!=', $event_price)
                    ->orderBy($sortBy, $orderBy)
                    ->paginate($perPage);  
    }

    public function getTotalAttendeesForAnEvent($eventId)
    {
        $collection = $this->model
                            ->where('event_id', $eventId)
                            ->get();

        return $collection->count();
    }

    public function findByLastName($eventId, $lastName, $perPage=20)
    {

        return $this->model
                    ->where('event_id', $eventId)
                    ->where('lastname', $lastName)
                    ->paginate($perPage);
    }

    public function findByFirstName($eventId, $firstName, $perPage=20)
    {

        return $this->model
                    ->where('event_id', $eventId)
                    ->where('firstname', $firstName)
                    ->paginate($perPage);
    }

    public function findByFullName($eventId, $firstName, $lastName, $perPage=20)
    {
        if (is_null($this->userParentOrganizationId))
        {
            return $this->model
                        ->where('event_id', $eventId)
                        ->where('firstname', $firstName)
                        ->where('lastname', $lastName)
                        ->paginate($perPage);
        }
        else
        {
             return $this->model
                        ->where('organization_id', $this->userOrganizationId)
                        ->where('event_id', $eventId)
                        ->where('firstname', $firstName)
                        ->where('lastname', $lastName)
                        ->paginate($perPage);           
        }

    }

    /**
     * Return collection of Attendees based on parameters
     * @param  [type] $eventId   [description]
     * @param  [type] $firstName [description]
     * @param  [type] $lastName  [description]
     * @return [type]            [description]
     */
    public function search($eventId, array $conditions = [])
    {

        $eventPrice = Event::find($eventId)->price_cents;

        if (!empty($eventId))
        {

            $query = $this->model->where('event_id', $eventId);
            
            foreach($conditions as $key => $value)
            {
                if(!empty($value))
                {
                    if ($key == 'fee_status')
                    {
                        if ($value == 'paid')
                        {
                            $query = $query->where('amount_paid', $eventPrice);
                        }
                        else if ($value == 'not_paid')
                        {
                            $query = $query->where(function ($query1) use($eventPrice){
                                $query1->whereNull('amount_paid')
                                            ->orWhere('amount_paid', '!=', $eventPrice);
                            });
                            
                            //$query = $query->whereNull('amount_paid', '<>', $eventPrice);
                        }
                    }
                    else
                    {
                        $query = $query->where($key, $value);  
                    }              
                } 

            }

            if (is_null($this->userParentOrganizationId))
            {
                return $query                    
                        ->orderBy('firstname', 'asc')
                        ->paginate(20);
            }
            else
            {
                return $query
                    ->where('organization_id', $this->userOrganizationId)                    
                    ->orderBy('firstname', 'asc')
                    ->paginate(20);
            }


        }
    }

}