<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;

class EventRepository extends BaseRepository implements EventRepositoryInterface {

    public function __construct(Event $event)
    {
        $this->model = $event;
    }

    /**
     * @param  integer $perPage [description]
     * @return [type]           [description]
     */
    public function findAllPaginatedOrderedByDate($perPage = 20)
    {
        return $this->model
                    ->orderBy('start_date', 'desc')
                    ->paginate($perPage);
    }

    public function getActiveEvents()
    {
        return $this->model
                    ->where('end_date', '>=', BaseDateTime::now())
                    ->where('published', true)
        			->get();
    }

    public function activeEventsCount()
    {
        $colOfEvents = $this->getActiveEvents();
        return $colOfEvents->count();
    }
}