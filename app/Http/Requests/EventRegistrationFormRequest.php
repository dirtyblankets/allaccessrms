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
            'attendee_application_form.student_phone' => 'required|phone_number',
            'attendee_application_form.student_grade' => 'required',
            'attendee_application_form.sweatshirt_size' => 'required',
            'attendee_application_form.language' => 'required',
            'attendee_application_form.address' => 'required',
            'attendee_application_form.city' => 'required',
            'attendee_application_form.state' => 'required',
            'attendee_application_form.zipcode' => 'required|digits:5|integer',
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
            'attendee.firstname' => 'Application - First name is required.',
            'attendee.lastname' => 'Application - Last name is required.',

        ];
    }
}