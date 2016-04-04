<?php

use AllAccessRMS\Accounts\Users\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        if (App::environment() === 'production') {
            exit('Seed should be run only in development/debug environment.');
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_user')->truncate();

        // Root user
        $user = User::find(1);
        $user->assignRole('owner');

        $user = User::find(2);
        $user->assignRole('admin');

        $user = User::find(3);
        $user->assignRole('admin');

        $user = User::find(4);
        $user->assignRole('moderator');

        $user = User::find(5);
        $user->assignRole('moderator');
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
