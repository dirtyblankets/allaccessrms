<?php namespace AllAccessRMS\AllAccessEvents;

use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Core\BaseRepository;

use AllAccessRMS\DocumentDefinitions\ApplicationForm;
use AllAccessRMS\DocumentDefinitions\HealthAndReleaseForm;

class EventRepository extends BaseRepository implements EventRepositoryInterface {

    public function __construct(Event $event)
    {
        parent::__construct($event);
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

    public function createEmptyEvent($organization_id)
    {
        $newEvent = parent::create(array('organization_id' => $organization_id));

        $appForm = new ApplicationForm();
        $newEvent->applicationForm()->save($appForm);

        $healthForm = new HealthAndReleaseForm(array(
            'liability_statement' => "1. I, the undersigned, hereby give permission for the above named child to attend the sponsored program by
LOLYA(Live Out Loud Youth Alliance) and Joint Churches in Camp Cedar Crest. I agree to release and hold
harmless of LOLYA and the joint churches sponsoring this event and also Camp Cedar Crest or its agents for any
and all claims for injuries, causes of action, the rendering of emergency care, or liability related to use or
participation in all activities.
These activities may include, but are not limited to: Transportation, Hiking, walking, group activities, and other
recreational activities. I also give permission for participation in any offsite activities and/or to be transported to and
from any offsite activities, or emergency locations, if any, by authorized vehicles. This also includes any
transportation to and from church to the conference center and back.
2. I hereby give my permission for nonprescription medication and first aid treatment to be given to the child if
deemed advisable by the Joint Church Leaders and/or Camp Cedar Crest Staffs.
3. In the event that I cannot be reached in an emergency and my child requires treatment, I hereby give permission to
the physician selected by the child’s Joint Church leaders and/or Camp Cedar Crest staff to hospitalize, secure
proper treatment for, and to order injection, anesthesia or surgery for the above named child.  
  
4. I give permission to LOLYA and the Joint Retreat Churches to photograph and video tape the child for the use in
any future promotional materials, including any website postings, without expectation of compensation.  
  
I have read and understand this Release of Liability Declaration, and voluntarily sign it."
            ));

        $newEvent->healthForm()->save($healthForm);

        return $newEvent;
    }

    public function activeEventsCount()
    {
        $colOfEvents = $this->getActiveEvents();
        return $colOfEvents->count();
    }
}