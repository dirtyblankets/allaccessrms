<?php namespace AllAccessRMS\EventRegistrations;

use AllAccessRMS\Core\BaseRepository;

class EventRepository extends BaseRepository implements EventRepositoryInterface {

    public function __construct(Event $event)
    {
        $this->model = $event;
    }
}