<?php namespace AllAccessRMS\Http\Requests;

class EventRegistrationFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            
            'attendee.organization_id' => 'required',
            'attendee.email' => 'required|email|unique:attendees,email,'.'event_id['.$this->get('event_id').']',
            'attendee.firstname' => 'required',
            'attendee.lastname' => 'required',

            'attendee_application_form.phone' => 'required|phone_number',
            'attendee_application_form.grade' => 'required',
            'attendee_application_form.sweatshirt_size' => 'required',
            'attendee_application_form.address' => 'required',
            'attendee_application_form.city' => 'required',
            'attendee_application_form.state' => 'required',
            'attendee_application_form.zipcode' => 'required|digits:5|integer',
            'attendee_application_form.birthdate' => 'required|date',
            
            'attendee_health_release_form.gender' => 'required',
            'attendee_health_release_form.emgcontactname' => 'required',
            'attendee_health_release_form.emgcontactrel' => 'required',
            'attendee_health_release_form.emgcontactnumber' => 'required|phone_number',
            'attendee_health_release_form.guardianfullname' => 'required',
            'attendee_health_release_form.guardian_phone' => 'required|phone_number',
            'parent_signature' => 'required',
            
        ];
    
    }

    public function messages()
    {
        return [
            'attendee.organization_id.required' => 'Application - Which Organization do you belong to?',
            'attendee.email.unique' =>  'Application - You have already registered for this event.',
            'attendee.email.required' => 'Application - Email is required.',
            'attendee.email.email' => 'Application - Email is invalid.',
            'attendee.firstname.required' => 'Application - First name is required.',
            'attendee.lastname.required' => 'Application - Last name is required.',
            'attendee_application_form.phone.required' => 'Application - Phone is required.',
            'attendee_application_form.grade.required' => 'Application - Grade Level is required.',
            'attendee_application_form.sweatshirt_size.required' => 'Application - Sweatshirt size is required.',
            'attendee_application_form.address.required' => 'Application - Address: street address is required.',
            'attendee_application_form.city.required' => 'Application - Address: city is required',
            'attendee_application_form.state.required' => 'Application - Address: state is required.',
            'attendee_application_form.zipcode.required' => 'Application - Address: zipcode is required.',
            'attendee_application_form.zipcode.digits' => 'Application - Address: zipcode must be a 5 digit number.',
            'attendee_application_form.birthdate.required' => 'Application - Birthdate is required.',
            'attendee_application_form.birthdate.date' => 'Application - Birthdate must be a valid date.',
            'attendee_health_release_form.gender.required' => 'Health and Release Form - Gender is required',
            'attendee_health_release_form.emgcontactname.required' => 'Health and Release Form - Emergency contact name is required.',
            'attendee_health_release_form.emgcontactrel.required' => 'Health and Release Form - Emergency contact relationship is required.',
            'attendee_health_release_form.emgcontactnumber.required' => 'Health and Release Form - Emergency contact phone number is required.',
            'attendee_health_release_form.emgcontactnumber.phone_number' => 'Health and Release Form - Emergency contact number must be a valid phone number.',
            'attendee_health_release_form.guardianfullname.required' => 'Health and Release Form - Parent/Guardian name is required.',
            'attendee_health_release_form.guardian_phone.required' => 'Health and Release Form - Parent/Guardian phone number is required.',
            'attendee_health_release_form.guardian_phone.phone_number' => 'Health and Release Form - Parent/Guardian phone number must be a valid phone number.',
            'parent_signature.required' => 'Health and Release Form - Parent/Guardian signature is required. Please click save after signing.' 

        ];
    }
}