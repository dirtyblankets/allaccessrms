<?php namespace AllAccessRMS\Http\Requests;

use Carbon\Carbon;

class PublishEventFormRequest extends Request
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
            'event.startdate'  =>  'required|date|after:yesterday',
            'event.enddate'  =>  'required|date|after:' . Carbon::parse($this->startdate)->subDay()->toDateString(),
            'event.cost'    =>  'required|dollar_amount',
            'event.starttime' => 'required|date_format:H:i a',
            'event.endtime' =>  'required|date_format:H:i a'
        ];
    }

    public function messages()
    {
        return [
            'event.title'   =>  'An Event title is required.',
            'event.cost.required'    =>  'Please enter cost of event.  If no cost, enter 0.',
            'event.startdate.required'  =>  'Start date is required.',
            'event.enddate.required'    =>  'End date is required.',
            'event.startdate.date'  =>  'Start date must be a date.',
            'event.enddate.date'    =>  'End date must be a date.',
            'event.startdate.after'   =>  'Start date must be on today or on a future date.',
            'event.enddate.after'  =>  'End date must be on or after the Start Date',
            'event.starttime.required'   =>  'Start time is required.',
            'event.endtime.required' =>  'End time is required.'
        ];
    }
}