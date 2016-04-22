<?php

namespace AllAccessRMS\Http\Controllers;

use Illuminate\Http\Request;

use AllAccessRMS\Http\Requests;
use AllAccessRMS\Http\Controllers\Controller;

use AllAccessRMS\AllAccessEvents\Attendee;

class BillingController extends Controller
{
    public function payment()
    {
        return view('public.events.pay_online');
    }
}
