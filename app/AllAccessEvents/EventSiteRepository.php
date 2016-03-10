<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;

class EventSiteRepository extends BaseRepository implements EventSiteRepositoryInterface {
    
    public function __construct(EventSite $eventSite)
    {
        parent::__construct($eventSite);
    }

    public function createEmptyEventSite($event_id)
    {
        return parent::create(array('event_id' => $event_id));
    }

}