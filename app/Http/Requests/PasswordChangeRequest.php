<?php namespace AllAccessRMS\Http\Requests;

class PasswordChangeRequest extends Request
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
            'current_password'  => 'required|min:5',
            'new_password'      =>  'required|min:5|confirmed',
            'new_password_confirmation' =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' =>  'Please enter your current password',
            'current_password.min'  =>  'Password should be at least 5 characters in length.',
            'new_password.min'  =>  'Password should be at least 5 characters in length.',
            'new_password.required'  =>  'Please enter a new password.',
            'new_password.confirmed'  =>  'Please reenter your new password.',
        ];
    }
}
