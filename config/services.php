<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'sandbox36c22937e919444aa717f68ed91cfcf9.mailgun.org',
        'secret' => 'key-564b890e7c3f7b5678540efcf8bddc2a',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\AllAccesRMS\AllAccessEvents\Attendee::class,
        'key'    => env('STRIPE_PUBLIC'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
