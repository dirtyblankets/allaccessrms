<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseValidator;
use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;

class EventRegistrationValidator extends BaseValidator 
{

	protected $eventRepository;

	protected $attendeeRepository;

	public function __construct(EventRepositoryInterface $eventRepository,
									AttendeeRepositoryInterface $attendeeRepository)
	{
		$this->eventRepository = $eventRepository;
		$this->attendeeRepository = $attendeeRepository;
	}

	/**
	 * [noEventCapacity description]
	 * @param  [type] $eventId [description]
	 * @return [boolean]          [description]
	 */
	public function noEventCapacity($eventId)
	{

		$event = $this->eventRepository->findById($eventId);
		$currentAttendeeCount = $this->attendeeRepository->getTotalAttendeesForAnEvent($eventId);

		return ($event->capacity <= $currentAttendeeCount) ? true : false;
	}

}