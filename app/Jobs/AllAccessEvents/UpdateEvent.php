<?php namespace AllAccessRMS\Jobs\AllAccessEvents;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Jobs\Job;
use AllAccessRMS\Accounts\Organizations\PartnerOrganization;
use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\AllAccessEvents\EventSite;

class UpdateEvent extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    protected $event;

    public function __construct($request, Event $event)
    {
        $this->request = $request;
        $this->event = $event;
    }

    public function handle()
    {
        $event = $this->updateEvent();

        return $event;
    }

    private function updateEvent()
    {

        $this->event->title         =  $this->request->input('event.title');
        $this->event->description   =  $this->request->input('event.description');
        $this->event->start_date    =  $this->request->input('event.startdate');
        $this->event->end_date      =  $this->request->input('event.enddate');
        $this->event->start_time    =  $this->request->input('event.starttime');
        $this->event->end_time      =  $this->request->input('event.endtime');
        $this->event->price         =  $this->request->input('event.cost');
        $this->event->published     =  true;
        $this->event->save();

        // 2. Save Event Location Information
        $eventSite = $this->event->eventsite()->first();
        $eventSite->name    =   $this->request->input('eventsite.name');
        $eventSite->address =   $this->request->input('eventsite.address');
        $eventSite->city    =   $this->request->input('eventsite.city');
        $eventSite->state   =   $this->request->input('eventsite.state');
        $eventSite->zipcode =   $this->request->input('eventsite.zipcode');
        $eventSite->save();

        // 3. Detach all Partner Organizations set for this Event
        $orgRepo = new OrganizationRepository(new Organization());
        $partnerOrganizations = $orgRepo->getPartnerOrganizations($this->event->organization()->first()->id);
        foreach ($partnerOrganizations as $partnerOrg)
        {
            $this->event->partners()->detach($partnerOrg);
        }

        // 4. Add select Partner Organizations to the Event
        if (!is_null($this->request->input('partners')))
        {
            foreach ($this->request->input('partners') as $selectedPartners)
            {
                $partner = PartnerOrganization::find($selectedPartners);
                $this->event->partners()->attach($partner);
            }
        }
    }
}