<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseRepositoryInterface;

interface EventRepositoryInterface extends BaseRepositoryInterface
{
    public function findAllPaginatedOrderedByDate($perPage = 20);

    public function getActiveEvents();

    public function createEmptyEvent($organization_id);

    public function activeEventsCount();

}