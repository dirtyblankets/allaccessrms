<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseRepositoryInterface;

interface EventSiteRepositoryInterface extends BaseRepositoryInterface
{

    public function createEmptyEventSite($event_id);

}