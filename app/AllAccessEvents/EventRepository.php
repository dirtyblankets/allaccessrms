<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\AllAccessEvents\EventRegistrationForm;

use AllAccessRMS\AttendeeDocuments\AttendeeApplicationForm;
use AllAccessRMS\AttendeeDocuments\AttendeeHealthAndReleaseForm;

class EventRepository extends BaseRepository implements EventRepositoryInterface 
{

    public function __construct()
    {
        $event = new Event();
        parent::__construct($event);
    }

    /**
     * @param  integer $perPage [description]
     * @return [type]           [description]
     */
    public function findAllPaginatedOrderedByDate($perPage = 20)
    {
        return $this->model
                    ->orderBy('start_date', 'asc')
                    ->paginate($perPage);
    }

    public function getActiveEvents()
    {
        return $this->model
                    ->where('end_date', '>=', BaseDateTime::now())
                    ->where('published', true)
                    ->orderBy('start_date', 'asc')
        			->get();
    }

    public function createEmptyEvent($organization_id)
    {
        $newEvent = parent::create(array('organization_id' => $organization_id));

        $registrationForm = new EventRegistrationForm();
        $newEvent->registration_form()->save($registrationForm);

        return $newEvent;
    }

    public function activeEventsCount()
    {
        $colOfEvents = $this->getActiveEvents();
        return $colOfEvents->count();
    }
}