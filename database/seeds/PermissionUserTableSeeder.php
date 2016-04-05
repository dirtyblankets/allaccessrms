<?php

use AllAccessRMS\Accounts\Users\User;
use AllAccessRMS\Accounts\Users\Permission;
use Illuminate\Database\Seeder;

class PermissionUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production') {
            exit('Seed should be run only in development/debug environment.');
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('permission_user')->truncate();

        $partnerAdmin = User::where('email', 'root@allaccessrms.com')->first();
        $partnerAdmin->assignPermission('users');
        $partnerAdmin->assignPermission('events');
        $partnerAdmin->assignPermission('organizations');
        $partnerAdmin->assignPermission('attendees');

        $partnerAdmin = User::where('email', 'admin1@partner1.com')->first();
        $partnerAdmin->assignPermission('users');
        $partnerAdmin->assignPermission('attendees');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
