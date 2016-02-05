<?php

use Illuminate\Database\Seeder;

class OrganizationInfoTableSeeder extends Seeder
{
    public function run()
    {
        if (App::environment() === 'production')
        {
            exit('Seed should be run only in development/debug environment.');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('organization_info')->truncate();

        OrganizationInfo::create([
            'id'            =>  1,
            'organization_id' => 1,
            'address'       =>  '1234 Magnolia Ave.',
            'city'          =>  'Anaheim',
            'state'         =>  'CA',
            'zipcode'       =>  '92804',
            'country'		=>	'USA'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
