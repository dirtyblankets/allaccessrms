<?php namespace AllAccessRMS\Http\Requests;

class RegisterAttendeeFormRequest extends Request
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
            'studentapplication.student_phone' => 'required|phone_number',
            'studentapplication.parent_phone' => 'required|phone_number',
            'studentapplication.student_grade' => 'required',
            'studentapplication.sweatshirt_size' => 'required',
            'parent_signature' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'attendee.email.unique' =>  'You have already registered for this event.'
        ];
    }
}