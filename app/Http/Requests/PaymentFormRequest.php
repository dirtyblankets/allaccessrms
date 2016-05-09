<?php namespace AllAccessRMS\Http\Requests;

use AllAccessRMS\Http\Requests\Request;

class PaymentFormRequest extends Request
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
            'email' =>  'required|email|confirmed|exists:attendees,email,id,'. $this->attendee,
            'email_confirmation' => 'required'

        ];
    
    }

    public function messages()
    {
        return [

        ];
    }
}