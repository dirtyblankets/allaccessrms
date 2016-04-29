<?php namespace AllAccessRMS\Http\Requests;

class FirstTimeLoginFormRequest extends Request
{

    private $user_id;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user_id = $this->route('user_id');

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
            'email' => 'required|email|exists:user,email,id,'. $user_id,
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5'
        ];
    
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is a required field.',
            'email.email'   =>  'Plese enter a valid email.',
            'email.exists'  =>  'Incorrect Email.',
            'password.required' =>  'Please enter a password of your choice.',
            'password.confirmed'    =>  'Please re-enter the correct password.',
            'password_confirmation.required'    =>  'Please re-enter a password of your choice.'
        ];
    }
}