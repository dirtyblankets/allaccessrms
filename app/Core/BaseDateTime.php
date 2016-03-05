<?php namespace AllAccessRMS\Core;

use Carbon\Carbon;

class BaseDateTime
{
    public static function now()
    {
        return Carbon::now('America/Los_Angeles');
    }
}