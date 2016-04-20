<?php namespace AllAccessRMS\Jobs\AllAccessEvents;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Contracts\Queue\ShouldQueue;

use AllAccessRMS\Jobs\Job;
use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\AllAccessEvents\EventRepository;
use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AttendeeDocuments\AttendeeApplication;
use AllAccessRMS\AttendeeDocuments\AttendeeHealthReleaseForm;
use AllAccessRMS\Jobs\SendRegistrationConfirmation;

class RegisterAttendee extends Job implements SelfHandling, ShouldQueue
{
    use DispatchesJobs;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $eventId = $this->request->input('event_id');
        $organizationId = $this->request->input('attendee.organization_id');

        $attendeeData = array(
            'firstname' => $this->request->input('attendee.firstname'),
            'lastname' => $this->request->input('attendee.lastname'),
            'email' => $this->request->input('attendee.email'),
            'registration_date' => BaseDateTime::now(),
        );


        $attendeeApplicationFormData = array(
            'student_phone' => $this->request->input('attendee_application_form.phone'),
            'student_grade' => $this->request->input('attendee_application_form.grade'),
            'language' => $this->request->input('attendee_application_form.language'),
            'sweatshirt_size' => $this->request->input('attendee_application_form.sweartshirt_size'),
            'address' => $this->request->input('attendee_application_form.address'),
            'city' => $this->request->input('attendee_application_form.city'),
            'state' => $this->request->input('attendee_application_form.state'),
            'zipcode' => $this->request->input('attendee_application_form.zipcode'),
        );
        


        $eventRepo = new EventRepository();
        $event = $eventRepo->findById($eventId);

        $organizationRepo = new OrganizationRepository();
        $organization = $organizationRepo->findById($organizationId);

        $newAttendee = new Attendee($attendeeData);

        $organization->attendees()->associate($newAttendee);
        $event->attendees()->associate($newAttendee);
        
        if ($event->attendee()->save($newAttendee)) {

            $mailData = array(
                'toEmail' => $newAttendee->email,
                'toName' => $newAttendee->firstname . ' ' . $newAttendee->lastname,
                'emailBody' => 'You have registered for the following event: ' . $event->title,
                'linkToEvent' => 'https://allaccessrms.dev/event/show/' . $event->id, 
            );

            $sendMail = new SendRegistrationConfirmation($mailData);
            $this->dispatch($sendMail);
        }

    }
}