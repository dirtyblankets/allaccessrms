<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Accounts\Users;
use App\Accounts\Registration\NewUserRegistrationForm;

/*
class NewUserRegistratorTest extends TestCase
{

    public function testRegister()
    {	
        $registrator = new NewUserRegistrationForm();

        $input = array('organization'=>'Test Organization Name', 
        				'firstname'=>'Kap',
        				'lastname'=>'Choi',
        				'email'=>'test@email.com',
        				'password'=>'');

        $this->assertTrue($registrator->register($input));
        $user = User::where('firstname', 'Kap')->get();
        $user->delete();

    }
}
*/
