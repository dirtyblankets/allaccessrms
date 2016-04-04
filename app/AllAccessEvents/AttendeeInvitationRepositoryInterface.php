<?php namespace AllAccessRMS\AllAccessEvents;

interface AttendeeInvitationRepositoryInterface {

	public function findAllPaginatedByEvent($eventId ,$perPage = 10);

}