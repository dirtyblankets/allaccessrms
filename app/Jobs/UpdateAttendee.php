<?php namespace AllAccessRMS\Jobs;

use Carbon\Carbon;

use Illuminate\Contracts\Bus\SelfHandling;

use AllAccessRMS\Jobs\Job;

use AllAccessRMS\AllAccessEvents\AttendeeRepository;
use AllAccessRMS\Core\BaseDateTime;
use AllAccessRMS\Accounts\Organizations\OrganizationRepository;
use AllAccessRMS\AllAccessEvents\EventRepository;
use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AttendeeDocuments\AttendeeApplicationForm;
use AllAccessRMS\AttendeeDocuments\AttendeeHealthReleaseForm;
use AllAccessRMS\Jobs\SendRegistrationConfirmation;

use AllAccessRMS\AttendeeDocuments\AttendeeApplicationFormRepository;
use AllAccessRMS\AttendeeDocuments\AttendeeHealthReleaseFormRepository;

class UpdateAttendee extends Job implements SelfHandling
{

    protected $request;

    protected $attendeeId;

    public function __construct($request, $attendeeId)
    {
        $this->request = $request;

        $this->attendeeId = $attendeeId;
    }

    public function handle()
    {

        $attendeeRepository = new AttendeeRepository();
        
        $attendee = $attendeeRepository->findById($this->attendeeId);
        
        $appForm = $attendee->application_form()->first();

        $healthForm = $attendee->health_release_form()->first();

        $event = $attendee->event()->first();

        $attendeeData = array(
            'organization_id' => $this->request->input('organization'),
            'firstname' => $this->request->input('firstname'),
            'lastname' => $this->request->input('lastname'),
            'email' => $this->request->input('email'),
            'registration_date' => $this->request->input('registration_date'),
            'amount_paid'   => $this->request->input('fees_paid'),
        );

        $attendeeApplicationFormData = array(
            'student_phone' => $this->request->input('attendee.phone'),
            'student_grade' => $this->request->input('grade'),
            'language' => $this->request->input('languages'),
            'sweatshirt_size' => $this->request->input('sweatshirt_size'),
            'address' => $this->request->input('address'),
            'city' => $this->request->input('city'),
            'state' => $this->request->input('tate'),
            'zipcode' => $this->request->input('zipcode'),
            'country' => 'USA',
            'birthdate' => Carbon::parse($this->request->input('birthdate')),
        );
    

        $attendeeHealthReleaseFormData = array(
            'gender' => $this->request->input('gender'), 
            'emg_contactname' => $this->request->input('emgcontactname'), 
            'emg_contactrel' => $this->request->input('emgcontactrel'), 
            'emg_contactnumber' => $this->request->input('emgcontactnumber'), 
            'healthproblems' => $this->request->input('healthproblems'), 
            'allergies' => $this->request->input('allergies'), 
            'lasttetanusshot' => Carbon::parse($this->request->input('lasttetanusshot')), 
            'lastphysicalexam' => Carbon::parse($this->request->input('lastphysicalexam')), 
            'insurancecarrier' => $this->request->input('insurancecarrier'), 
            'insurancepolicynum' => $this->request->input('insurancepolicynum'), 
            'guardian_name' => $this->request->input('guardianfullname'), 
            'guardian_contact' => $this->request->input('guardian_phone'), 
            'guardian_relation' => $this->request->input('relationship'), 
        );

        $appFormRepo = new AttendeeApplicationFormRepository(new AttendeeApplicationForm());
        $appFormRepo->update($attendeeApplicationFormData, $appForm->attendee_id, 'attendee_id');

        $healthFormRepo = new AttendeeHealthReleaseFormRepository(new AttendeeHealthReleaseForm());

        $healthFormRepo->update($attendeeHealthReleaseFormData, $healthForm->attendee_id, 'attendee_id');


        /*
        if ($attendee->amount_paid == $event->price
                || $this->request->input('fees_paid') > $event->price)
        {
            unset($attendeeData['amount_paid']);
        }
        */
       
        $attendee->update($attendeeData);
    }
}