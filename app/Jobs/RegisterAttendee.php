<?php namespace AllAccessRMS\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

use AllAccessRMS\Http\Requests\Request;
use AllAccessRMS\AllAccessEvents\Event;

class RegisterAttendee extends Job implements SelfHandling, ShouldQueue
{
    use DispatchesJobs, InteractsWithQueue, SerializesModels;

    private $request;

    private $event;

    public function __construct(Request $request, Event $event)
    {
        $this->request = $request;
        $this->event = $event;
    }

    public function handle()
    {

    }
}