<?php namespace AllAccessRMS\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Accounts\Organizations\PartnerOrganization;
use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\AllAccessEvents\EventSite;

class PublishEvent extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    protected $organization;

    protected $event;

    public function __construct($request, Organization $organization, Event $event = null)
    {
        $this->request = $request;
        $this->organization = $organization;
        $this->event = $event;
    }

    public function handle()
    {
    	$event = $this->publishEvent();

        return $event;
    }

    private function publishEvent()
    {

        if ($this->event)
        {   
            $event = $this->event;
        }
        else
        {
            $event = new Event();
        }

        // 1.  Set Event Attributes and Publish
    	$event->title = $this->request->input('event.title');
    	$event->description = $this->request->input('event.description');
    	$event->start_date = $this->request->input('event.startdate');
    	$event->end_date = $this->request->input('event.enddate');
    	$event->start_time = $this->request->input('event.starttime');
    	$event->end_time = $this->request->input('event.endtime');
    	$event->price = $this->request->input('event.cost');
    	$event->capacity = $this->request->input('event.capacity');
        $event->published = true;
        $this->organization->events()->save($event);

        $eventSite = $event->eventsite()->first();
        if (is_null($eventSite))
        {
            $eventSite = new EventSite();
        }

        // 2. Save Event Location Information
        $eventSite->name = $this->request->input('eventsite.name');
        $eventSite->address = $this->request->input('eventsite.address');
        $eventSite->city = $this->request->input('eventsite.city');
        $eventSite->state = $this->request->input('eventsite.state');
        $eventSite->zipcode = $this->request->input('eventsite.zipcode');
        
        $event->eventsite()->save($eventSite);
        //$event->save();

        // 3. Detach all Partner Organizations set for this Event
        $newOrg = new Organization();
        $orgRepo = new OrganizationRepository($newOrg);
        $partnerOrganizations = $orgRepo->getPartnerOrganizations($this->organization->id);
        foreach ($partnerOrganizations as $partnerOrg)
        {
            $event->partners()->detach($partnerOrg);
        }

        // 4. Add select Partner Organizations to the Event
        foreach ($this->request->input('partners') as $selectedPartners)
        {
            $partner = PartnerOrganization::find($selectedPartners);
            $event->partners()->attach($partner);
        }

    	return $event;
    }

}