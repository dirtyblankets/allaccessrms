<?php namespace AllAccessRMS\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

use AllAccessRMS\AllAccessEvents\AttendeeRepositoryInterface;

class AttendeeRegistrationPayment
{

    protected $attendees;

    public function __construct(AttendeeRepositoryInterface $attendees)
    {
        $this->attendees = $attendees;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $registeredAttendee = $this->attendees
                                    ->findByEventAndAttendeeId($request->event, $request->attendee);

        if ($registeredAttendee)
        {
            return $next($request);
        }

        return response('Unauthorized.', 401);
    }
}
