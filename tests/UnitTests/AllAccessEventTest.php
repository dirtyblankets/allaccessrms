<?php

use Carbon\Carbon;
use AllAccessRMS\AllAccessEvents\Event;

class AllAccessEventTest extends \TestCase
{
    public function testInstance()
    {
        new Event();
    }

    public function testStartTime()
    {
    	$startime = "1:00 pM";

    	$startime = date("H:i:s", strtotime($startime));

    	$startime = date("h:i a", strtotime($startime));
    	dd($startime);
    }

}