<?php namespace AllAccessRMS\Jobs;

use Exception;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Jobs\Job;
use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\AllAccessEvents\EventRepository;
use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AttendeeDocuments\AttendeeApplicationForm;
use AllAccessRMS\AttendeeDocuments\AttendeeHealthReleaseForm;
use AllAccessRMS\Jobs\SendRegistrationConfirmation;

class RegisterAttendee extends Job implements SelfHandling
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

        if (empty($eventId)) 
        {
            throw new Exception("EventID empty.");
        }

        if (empty($organizationId)) 
        {
            throw new Exception("OrganizationID empty.");
        }

        $attendeeData = array(
            'event_id' => $eventId,
            'organization_id' => $organizationId,
            'firstname' => $this->request->input('attendee.firstname'),
            'lastname' => $this->request->input('attendee.lastname'),
            'email' => $this->request->input('attendee.email'),
            'registration_date' => BaseDateTime::now(),
        );

        $attendeeApplicationFormData = array(
            'student_phone' => $this->request->input('attendee_application_form.phone'),
            'student_grade' => $this->request->input('attendee_application_form.grade'),
            'language' => $this->request->input('attendee_application_form.language'),
            'sweatshirt_size' => $this->request->input('attendee_application_form.sweatshirt_size'),
            'address' => $this->request->input('attendee_application_form.address'),
            'city' => $this->request->input('attendee_application_form.city'),
            'state' => $this->request->input('attendee_application_form.state'),
            'zipcode' => $this->request->input('attendee_application_form.zipcode'),
            'country' => 'USA',
            'birthdate' => Carbon::parse($this->request->input('attendee_application_form.birthdate')),
        );
        
        $attendeeHealthReleaseFormData = array(
            'gender' => $this->request->input('attendee_health_release_form.gender'), 
            'emg_contactname' => $this->request->input('attendee_health_release_form.emgcontactname'), 
            'emg_contactrel' => $this->request->input('attendee_health_release_form.emgcontactrel'), 
            'emg_contactnumber' => $this->request->input('attendee_health_release_form.emgcontactnumber'), 
            'healthproblems' => $this->request->input('attendee_health_release_form.healthproblems'), 
            'allergies' => $this->request->input('attendee_health_release_form.allergies'), 
            'lasttetanusshot' => Carbon::parse($this->request->input('attendee_health_release_form.lasttetanusshot')), 
            'lastphysicalexam' => Carbon::parse($this->request->input('attendee_health_release_form.lastphysicalexam')), 
            'insurancecarrier' => $this->request->input('attendee_health_release_form.insurancecarrier'), 
            'insurancepolicynum' => $this->request->input('attendee_health_release_form.insurancepolicynum'), 
            'guardian_name' => $this->request->input('attendee_health_release_form.guardianfullname'), 
            'guardian_contact' => $this->request->input('attendee_health_release_form.guardian_phone'), 
            'guardian_relation' => $this->request->input('attendee_health_release_form.relationship'), 
            'guardian_sign' => $this->request->input('parent_signature'), 
        );

        $appForm = new AttendeeApplicationForm($attendeeApplicationFormData);

        $healthReleaseForm = new AttendeeHealthReleaseForm($attendeeHealthReleaseFormData);

        $eventRepo = new EventRepository();
        $event = $eventRepo->findById($eventId);

        $organizationRepo = new OrganizationRepository();
        $organization = $organizationRepo->findById($organizationId);

        $newAttendee = new Attendee($attendeeData);
        // Save new attendee
        $newAttendee = $newAttendee->create($attendeeData);
        $newAttendee->application_form()->save($appForm);
        $newAttendee->health_release_form()->save($healthReleaseForm);

        $newAttendee->save();
        if (!empty($newAttendee->id)) 
        {

            try {
            
                $this->dispatch(new SendRegistrationConfirmation($newAttendee, $event));
            
            } catch (Exception $e) {

                Log::error('Could not process SendRegistrationConfirmation job.');
            
            }

        }

    }
}