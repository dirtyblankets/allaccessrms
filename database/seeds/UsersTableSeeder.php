<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use AllAccessRMS\Accounts\Users\User;

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

        $user = User::create([
            'organization_id'   =>  1,
            'email'             =>  'admin@allaccessrms.com',
            'password'          =>  'password',
            'firstname'         =>  'Admin',
            'lastname'          =>  'User',
            'active'            =>  1
        ]);

        $user = User::create([
            'organization_id'   =>  2,
            'email'             =>  'moderator1@partner1.com',
            'password'          =>  'password',
            'firstname'         =>  'Moderator1',
            'lastname'          =>  'User',
            'active'            =>  1
        ]);

        $user = User::create([
            'organization_id'   =>  3,
            'email'             =>  'moderator2@partner2.com',
            'password'          =>  'password',
            'firstname'         =>  'Moderator2',
            'lastname'          =>  'User',
            'active'            =>  1
        ]);

        $user = User::create([
            'organization_id'   =>  4,
            'email'             =>  'moderator3@partner3.com',
            'password'          =>  'password',
            'firstname'         =>  'Moderator3',
            'lastname'          =>  'User',
            'active'            =>  1
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}