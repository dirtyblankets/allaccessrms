<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;

class AttendeeInvitationRepository extends BaseRepository implements AttendeeInvitationRepositoryInterface {

	public function __construct(AttendeeInvitation $eventGuest)
    {
        parent::__construct($eventGuest);
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

    public function findByEmail($email)
    {
        return $this->model
                    ->where('attendee_email', $email)
                    ->get();
    }
}