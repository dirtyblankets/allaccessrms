<?php
/** @var \Illuminate\Validation\Factory $validator */

Validator::extend(
    'valid_password',
    function ($attribute, $value, $parameters)
    {
        return preg_match('/^[a-zA-Z0-9!@#$%\/\^&\*\(\)\-_\+\=\|\[\]{}\\\\?\.,<>`\'":;]+$/u', $value);
    }
);

Validator::extend(
    'phone_number',
    function ($attribute, $value, $parameters)
    {
        return strlen(preg_replace('#^.*([0-9]{3})[^0-9]*([0-9]{3})[^0-9]*([0-9]{4})$#', '$1$2$3', $value)) == 10;
    }
);

Validator::extend(
    'dollar_amount',
    function($attribute, $value, $parameters)
    {
        return preg_match('/^\d*(\.\d{2})?$/', $value);
    }
);