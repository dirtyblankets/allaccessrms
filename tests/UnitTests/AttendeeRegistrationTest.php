<?php

use Carbon\Carbon;
use ALlAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\AllAccessEvents\Attendee;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\AllAccessEvents\Registration;

class TestRelationships extends \TestCase
{

    protected $organization;

	protected $event;

    protected $attendee;

    public function setUp(){

        parent::setUp();

        $this->organization = Organization::find(1);

        $this->event = new Event([
            'title' => 'Test Event',
            'description' => 'This is an awesome event!',
            'start_date' => '03/01/2016',
            'end_date' => '03/12/2016',
            'start_time' => '08:00 AM',
            'end_time' => '02:00 PM',
            'contact_phone' => '7147771234',
            'price' => 125.00,
            'capacity' => 400,
            'published' => true,
            'private' => false
        ]);

        $this->organization->events()->save($this->event);

        $this->attendee = new Attendee([
            'email' => 'testattendee@test.com',
            'firstname' => 'Samuel',
            'lastname' => 'Jackson',
        ]);

        $this->attendee->organization()->associate($this->organization);
        $this->attendee->event()->associate($this->event);
        $this->attendee->save();
        
    }

    public function tearDown(){
        $this->attendee->delete();
        $this->event->delete();
        parent::tearDown();

    }

    public function testEventCreated()
    {
        $this->assertNotEmpty($this->event);
    }

    public function testAttendeeAdded()
    {
        $attendee = Attendee::where('organization_id', '=', 1)->first();
        $this->assertNotEmpty($attendee);   
    }

}