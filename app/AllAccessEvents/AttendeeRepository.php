<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;

use AllAccessRMS\AllAccessEvents\Attendee;

class AttendeeRepository extends BaseRepository {

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
    public function findAllPaginatedByEvent($eventId ,$perPage = 10)
    {
        return $this->model
        			->where('event_id', $eventId)
                    ->orderBy('attendee_email')
                    ->paginate($perPage);
    }
}