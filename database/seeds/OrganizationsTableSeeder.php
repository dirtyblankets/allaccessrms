<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use AllAccessRMS\Accounts\Organizations\Organization;

class OrganizationsTableSeeder extends Seeder
{
    public function run ()
    {
        if (App::environment() === 'production')
        {
            exit('Seed should be run only in development/debug environment.');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('organizations')->truncate();

        Organization::create([
            'id'            =>  1,
            'parent_id'     =>  null,
            'name'          =>  'All Access',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
