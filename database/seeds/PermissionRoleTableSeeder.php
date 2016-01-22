<?php

use AllAccessRMS\Accounts\Users\Role;
use AllAccessRMS\Accounts\Users\Permission;
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
         * Root
         */
        $role = Role::find(1);
        $role->assignPermission('user', 'event');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
