<?php namespace AllAccessRMS\Http\Requests;

class NewUserRegistrationRequest extends Request
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
            'organization_name' =>  'required',
            'firstname' =>  'required',
            'lastname'  =>  'required',
            'email'     =>  'required|email|confirmed|unique:users',
            'email_confirmation'    =>  'required|email'
        ];
    }

    public function messages()
    {
        return [
            'email.unique'  =>  'User with this email address already exists.'
        ];
    }
}
