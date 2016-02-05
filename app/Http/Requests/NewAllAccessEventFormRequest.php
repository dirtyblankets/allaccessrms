<?php namespace AllAccessRMS\Http\Requests;


class NewAllAccessEventFormRequest extends Request
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
            'event.title' =>  'required',
            'event.startdate'  =>  'required|unique:organizations',
            'event.enddate'  =>  'required|digits:5|integer',
            'event.cost'    =>  'required|dollar_amount'
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