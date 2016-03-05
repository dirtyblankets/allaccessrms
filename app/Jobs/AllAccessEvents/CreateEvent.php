<?php namespace AllAccessRMS\Jobs\AllAccessEvents;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Jobs\Job;
use AllAccessRMS\Accounts\Organizations\PartnerOrganization;
use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\AllAccessEvents\EventSite;

class CreateEvent extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    protected $organization;

    public function __construct($request, Organization $organization)
    {
        $this->request = $request;
        $this->organization = $organization;
    }

    public function handle()
    {
    	$event = $this->createEvent();

        return $event;
    }

    private function createEvent()
    {
        // 1.  Set Event Attributes and Save
        $event = new Event(array(
            'title'         =>  $this->request->input('event.title'),
            'description'   =>  $this->request->input('event.description'),
            'start_date'    =>  $this->request->input('event.startdate'),
            'end_date'      =>  $this->request->input('event.enddate'),
            'start_time'    =>  $this->request->input('event.starttime'),
            'end_time'      =>  $this->request->input('event.endtime'),
            'price'         =>  $this->request->input('event.cost'),
            'published'     =>  true
        ));
        $this->organization->events()->save($event);

        // 2. Save Event Location Information
        $eventSite = new EventSite(array(
            'name'      =>  $this->request->input('eventsite.name'),
            'address'   =>  $this->request->input('eventsite.address'),
            'city'      =>  $this->request->input('eventsite.city'),
            'state'     =>  $this->request->input('eventsite.state'),
            'zipcode'   =>  $this->request->input('eventsite.zipcode')
        ));
        $event->eventsite()->save($eventSite);

        // 3. Add select Partner Organizations to the Event
        if (!is_null($this->request->input('partners')))
        {
            foreach ($this->request->input('partners') as $selectedPartners)
            {
                $partner = PartnerOrganization::find($selectedPartners);
                $event->partners()->attach($partner);
            }
        }

    	return $event;
    }

}