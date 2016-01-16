<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Accounts\Users\User;

class UsersTableSeeder extends Seeder
{
    public function run ()
    {
        if (App::environment() === 'production') {
            exit('Seed should be run only in development/debug environment.');
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        $user = User::create([
            'organization_id'   =>  1,
            'email'             =>  'root@allaccessrms.com',
            'password'   	    =>	'password',
            'firstname'         =>  'Root',
            'lastname'          =>  'User',
            'active'            =>  1
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}