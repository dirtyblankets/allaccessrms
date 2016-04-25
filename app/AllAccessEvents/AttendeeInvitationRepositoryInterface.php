<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseRepositoryInterface;

interface AttendeeInvitationRepositoryInterface extends BaseRepositoryInterface{

	public function findAllPaginatedByEvent($eventId ,$perPage = 10);

}