<?php namespace AllAccessRMS\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Image;
use File;

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

    protected $publish;

    private $banner_img_prefix = "img_";

    private $banner_thumbnail_prefix = "thumbnail_";

    public function __construct($request, Event $event, $publish)
    {
        $this->request = $request;
        $this->event = $event;
        $this->publish = $publish;
    }

    public function handle()
    {
        $event = $this->updateEvent();

        return $event;
    }

    private function updateEvent()
    {

        if ($this->request->hasFile('image'))
        {
            $extension = $this->request->file('image')->getClientOriginalExtension();

            $image_path = 'images/public/' . $this->banner_img_prefix . $this->event->id . '.' .$extension;
            
            // Set Image Path in DB
            $this->event->img_url = $image_path;

            $image_path = public_path() . '/' . $image_path;

            $thumbnail_path = 'images/public/' . $this->banner_thumbnail_prefix . $this->event->id . '.' . $extension;
            $thumbnail_path = public_path() . '/' . $thumbnail_path;

            // Delete any existing files first
            File::delete($thumbnail_path);
            File::delete($image_path);

            $banner = Image::make($this->request->file('image'))
                            ->save($image_path);

            $thumbnail = Image::make($this->request->file('image'))
                            ->resize(450, 300)
                            ->save($thumbnail_path);

        }

        $this->event->title         =  $this->request->input('event.title');
        $this->event->description   =  $this->request->input('event.description');
        $this->event->start_date    =  $this->request->input('event.start_date');
        $this->event->end_date      =  $this->request->input('event.end_date');
        $this->event->start_time    =  $this->request->input('event.start_time');
        $this->event->end_time      =  $this->request->input('event.end_time');
        $this->event->price         =  $this->request->input('event.cost');
        $this->event->capacity      =  $this->request->input('event.capacity');
        $this->event->private       =  ($this->request->input('event_privacy') == 'private');
        $this->event->published     =  $this->publish;
        $this->event->save();

        // 2. Save Event Location Information
        $eventSite          =   $this->event->eventsite()->first();
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