<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseRepository;

class EventRepository extends BaseRepository implements EventRepositoryInterface {

    public function __construct(Event $event)
    {
        $this->model = $event;
    }
}