<?php namespace AllAccessRMS\Http\Controllers\Owner;

use Auth;
use Exception;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use AllAccessRMS\Http\Controllers\Controller;
use AllAccessRMS\Core\Utilities\States;
use AllAccessRMS\AllAccessEvents\Event;
use AllAccessRMS\Accounts\Organizations\Organization;
use AllAccessRMS\Accounts\Organizations\OrganizationRepositoryInterface;
use AllAccessRMS\Http\Requests\PublishEventFormRequest;

use AllAccessRMS\AllAccessEvents\EventRepositoryInterface;
use AllAccessRMS\AllAccessEvents\EventSiteRepositoryInterface;
use AllAccessRMS\AllAccessEvents\AttendeeInvitationRepositoryInterface;
use AllAccessRMS\Exceptions\Handler;

use AllAccessRMS\Jobs\AllAccessEvents\CreateEvent;
use AllAccessRMS\Jobs\AllAccessEvents\UpdateEvent;

class EventGuestsController extends Controller
{
    private $eventRepo;

    private $eventGuestRepo;

    public function __construct(EventRepositoryInterface $eventRepo, 
                                    AttendeeInvitationRepositoryInterface $eventGuestRepo)
    {
        $this->beforeFilter('auth');
        $this->eventRepo = $eventRepo;
        $this->eventGuestRepo = $eventGuestRepo;
    }

        /**
     * Add guests entered in modal to grid on create view.
     * @return Response
     */
    public function add(Request $request)
    {
        $eventId = $request->input('_data_event_id');
        $event = $this->eventRepo->findById($eventId);
        $guests = $request->input('guests_email');
        // split email address by space, comma, colon, or semi-colon
        $emailfromform = preg_split("/[\s,;:]+/", $guests);
        // Put them back together separated by a comma
        // string form
        $emailfromform = implode(",", $emailfromform);
        $guests_email = $emailfromform;
        // put it back into array form
        $guests = collect(explode(",", $emailfromform));

        // Validation rule
        $rules = array(
            'guests_email' => 'email|unique:event_guests,attendee_email,event_id['.$eventId.']',
        );

        // Validate Each Email
        foreach ($guests as $email)
        {
            $validator = Validator::make(array('guests_email' => $email), $rules);
            if ($validator->fails())
            {
                $openModal = 'true';
                return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput(['openModal'=>$openModal, 'guests_email'=>$email]);
            }
        }

        // Validation passed, continue adding emails to guest list for the given Event
        foreach ($guests as $email)
        {
            $guest = $this->eventGuestRepo->make(['attendee_email' => $email]);
            $event->guests()->save($guest);
        }

        $event->private = true;
        $event->save();

        return redirect()->route('owner::events.manage', array($eventId));
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $guest = $this->eventGuestRepo->findById($id);
        $eventId = $guest->event_id;
        $guest->delete();

        return redirect()->route('owner::events.manage', array($eventId));
    }
}