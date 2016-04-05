<?php

use AllAccessRMS\Accounts\Users\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
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
        DB::table('permission_role')->truncate();

        /*
         * Owner
         */
        $role = Role::find(1);
        $role->assignPermission('users', 'events', 'organizations', 'attendees');

        /*
         * Admin
         */
        $role = Role::find(2);
        $role->assignPermission('users', 'events', 'organizations', 'attendees');

        /*
         * Moderator
         */
        $role = Role::find(3);
        $role->assignPermission('attendees');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
