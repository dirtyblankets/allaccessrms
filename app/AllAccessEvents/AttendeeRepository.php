<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;
use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;

class AttendeeRepository extends BaseRepository implements AttendeeRepositoryInterface 
{

	public function __construct()
    {
        $attendee = new Attendee();
        parent::__construct($attendee);
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

    public function getTotalAttendeesForAnEvent($eventId)
    {
        $collection = $this->model
                            ->where('event_id', $eventId)
                            ->get();

        return $collection->count();
    }
}