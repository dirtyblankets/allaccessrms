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
            'password' => 'required|min:5|user:password'
        ];
    }

    public function messages()
    {
        return [
            'password.user'  =>  'Incorrect Password!'
        ];
    }
}
