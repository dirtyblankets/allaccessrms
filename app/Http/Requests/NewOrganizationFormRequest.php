<?php namespace AllAccessRMS\Http\Requests;

class NewOrganizationFormRequest extends Request
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
            'users.firstname' =>  'required',
            'users.lastname'  =>  'required',
            'users.email'     =>  'required|email|unique:users',
            'organizations.name'  =>  'required|unique:organizations',
            'organizationaddress.zipcode'  =>  'digits:5|integer'
        ];
    }

    public function messages()
    {
        return [
            'organizations.name.unique'   =>  'This organization has already been added.',
            'users.email.unique'  =>  'User with this email address already exists.'
        ];
    }
}