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
            'organization_id'   =>  2,
            'email'             =>  'davidkimsungkwang@gmail.com',
            'password'          =>  'password',
            'firstname'         =>  'David',
            'lastname'          =>  'Kim',
            'active'            =>  1
        ]);

        $user = User::create([
            'organization_id'   =>  3,
            'email'             =>  'jooheeryou@yahoo.com',
            'password'          =>  'password',
            'firstname'         =>  'Julie',
            'lastname'          =>  'Ryou-Choi',
            'active'            =>  1
        ]);

        $user = User::create([
            'organization_id'   =>  3,
            'email'             =>  'ocpc@yahoo.com',
            'password'          =>  'password',
            'firstname'         =>  'Kap',
            'lastname'          =>  'Choi',
            'active'            =>  1
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}