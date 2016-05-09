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
        return $this->model
                    ->where('event_id', $eventId)
                    ->where('firstname', $firstName)
                    ->where('lastname', $lastName)
                    ->paginate($perPage);
    }

}