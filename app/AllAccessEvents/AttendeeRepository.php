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

    /**
     * Return collection of Attendees based on parameters
     * @param  [type] $eventId   [description]
     * @param  [type] $firstName [description]
     * @param  [type] $lastName  [description]
     * @return [type]            [description]
     */
    public function search($eventId, $firstName, $lastName)
    {
        if (!empty($eventId))
        {
            if (!empty($lastName) && !empty($firstName))
            {
                $attendees = $this->findByFullName($eventId, $firstName, $lastName);
            }
            else if (!empty($lastName))
            {
                $attendees = $this->findByLastName($eventId, $lastName);
            }
            else if (!empty($firstName))
            {
                $attendees = $this->findByFirstName($eventId, $firstName);
            }
            else
            {
                $attendees = $this->findAllPaginatedByEvent($eventId, 'firstname', 'asc');
            }

            return $attendees;
        }
    }

}