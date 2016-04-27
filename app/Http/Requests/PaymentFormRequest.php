<?php namespace AllAccessRMS\Http\Requests;

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
            'attendee.email' => 'required|email|confirmed',
            'attendee.email_confirmation' => 'required|email'
            'attendee.firstname' => 'required',
            'attendee.lastname' => 'required',
        ];
    
    }

    public function messages()
    {
        return [

        ];
    }
}