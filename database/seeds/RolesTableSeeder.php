<?php 

use AllAccessRMS\Accounts\Users\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder {
	public function run () {
		if (App::environment() === 'production')
        {
			exit('Seed should be run only in development/debug environment.');
		}
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('roles')->truncate();

		$role = new Role();
		$role->name = 'Owner';
		$role->slug = 'owner';
		$role->description = 'root user';
		$role->save();

		$role = new Role();
		$role->name = 'Administrator';
		$role->slug = 'administrator';
		$role->description = 'administrator privileges';
		$role->save();

		$role = new Role();
		$role->name = 'Moderator';
		$role->slug = 'moderator';
		$role->description = 'moderator privileges';
		$role->save();
		
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}