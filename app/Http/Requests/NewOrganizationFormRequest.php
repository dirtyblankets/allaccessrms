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
            'user.firstname' =>  'required',
            'user.lastname'  =>  'required',
            'user.email'     =>  'required|email|unique:users,email',
            'organization.name'  =>  'required|unique:organizations,name',
            'organizationinfo.zipcode'  =>  'digits:5|integer',
            'organizationinfo.telephone'    =>  'phone:US'
        ];
    }

    public function messages()
    {
        return [
            'organization.name.unique'   =>  'This organization has already been added.',
            'user.email.unique'  =>  'User with this email address already exists.'
        ];
    }
}