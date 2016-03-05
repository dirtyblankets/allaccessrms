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
            'attendee.email'    =>  'required|email|unique:attendees,email,'.$this->get('event_id'),
            'attendee.firstname'    =>  'required',
            'attendee.lastname' =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'attendee.email.unique' =>  'You have already registered for this event.'
        ];
    }
}