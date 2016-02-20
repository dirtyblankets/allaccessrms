<?php namespace AllAccessRMS\Http\Controllers;

use AllAccessRMS\Accounts\Registration\RegisterNewOrganizationCommand;
use AllAccessRMS\Core\Commands\CommandBus;
use AllAccessRMS\Http\Requests\NewUserRegistrationRequest;

class NewUserRegistrationController extends Controller
{
    protected $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registration/newuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewUserRegistrationRequest $request)
    {
        // validate form input
        // if not valid, go back
        // otherwise, create new user record in db
        // send user confirmation email
        try {

            $input = $request->all();

            //create command
            $command = RegisterNewOrganizationCommand::withForm($request);

            //execute command
            $this->commandBus->execute($command);

            if ($this->newUserRegistrator->register($input))
            {
                // Send Welcome Email to New User
                return view('auth/login');
            }

        } catch (Exception $e) {

            return abort('404');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
