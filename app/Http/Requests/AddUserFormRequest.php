<?php namespace AllAccessRMS\Http\Requests;

class AddUserFormRequest extends Request
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
            'email'     =>  'required|email|unique:users,email',
            'firstname' =>  'required|alpha_spaces',
            'lastname'  =>  'required|alpha_spaces',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'First Name is required.',
            'firstname.alpha_spaces'    =>  'First Name can only contain alphabets and spaces',
            'lastname.required' =>  'Last Name is required.',
            'lastname.alpha_spaces' =>  'Last Name can only contain alphabets and spaces',
            'email.required'    =>  'Email is required',
            'email.email'   =>  'Email is invalid.',
            'email.unique'  =>  'User with this email address already exists.'
        ];
    }
}
