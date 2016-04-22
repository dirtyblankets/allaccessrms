<?php

use Carbon\Carbon;
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

        $org = Organization::create([
            'parent_id'     =>  null,
            'name'          =>  "All Access"
        ]);

        $org = Organization::create([
            'parent_id'     =>  1,
            'name'          =>  "Oaks Righteous Ministry"
        ]);

        $org = Organization::create([
            'parent_id'     =>  1,
            'name'          =>  "5Bread2Fish"
        ]);

        $org = Organization::create([
            'parent_id'     =>  1,
            'name'          =>  "Orange Caanan Presbyterian Church"
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
