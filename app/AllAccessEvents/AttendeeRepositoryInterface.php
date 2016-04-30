<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseRepositoryInterface;

interface AttendeeRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEventAndEmail($eventId, $email);

    public function findAllPaginatedByEvent($eventId , $sortBy, $orderBy, $perPage = 20);
}