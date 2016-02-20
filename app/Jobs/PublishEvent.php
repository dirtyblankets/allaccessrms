<?php namespace AllAccessRMS\Jobs;

use Laracasts\Flash\Flash;
use Exception;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\AllAccessEvents\EventSite;

class PublishEvent extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $request;

    protected $organization;

    protected $event;

    protected $event_id;

    public function __construct($request, Organization $organization, Event $event = null)
    {
        $this->request = $request;
        $this->organization = $organization;
        $this->event = $event;
    }

    public function handle()
    {
    	$newEvent = $this->register($this->request);
    }

    private function register($request)
    {

        if ($this->event)
        {   
            $event = $this->event;
        }
        else
        {
            $event = new Event();
        }


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
        //$event->save();

        $eventSite = $event->eventsite()->first();
        if (is_null($eventSite))
        {
            $eventSite = new EventSite();
        }
        $eventSite->name = $this->request->input('eventsite.name');
        $eventSite->address = $this->request->input('eventsite.address');
        $eventSite->city = $this->request->input('eventsite.city');
        $eventSite->state = $this->request->input('eventsite.state');
        $eventSite->zipcode = $this->request->input('eventsite.zipcode');
        
        $event->eventsite()->save($eventSite);
        $event->save();
    	return $event;
    }
}