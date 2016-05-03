<?php namespace AllAccessRMS\Http\Requests;

use AllAccessRMS\Requests\Request;

class OrganizationInfoFormRequest extends Request
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
            'name'  =>  'required|unique:organizations',
            'zipcode'  =>  'required|digits:5|integer',
            'telephone'    =>  'phone:US'
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  'Organization name is required.',
            'name.unique'   =>  'This organization has already been added.',
            'zipcode.required'  =>  'Zipcode is required.',
            'zipcode.integer'   =>  'Zipcode should consist of numbers only.',
            'telephone.phone'   =>  'Please enter a valid phone number.'
        ];
    }
}