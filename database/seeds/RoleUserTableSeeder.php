<?php

use App\Accounts\Users\User;
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

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
