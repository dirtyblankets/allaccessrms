<?php

use Illuminate\Database\Seeder;
use AllAccessRMS\Accounts\Organizations\OrganizationInfo;

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
            'organization_id' => 1,
            'address'       =>  '1234 Magnolia Ave.',
            'city'          =>  'Anaheim',
            'state'         =>  'CA',
            'zipcode'       =>  '92804',
            'country'		=>	'USA'
        ]);

        OrganizationInfo::create([
            'organization_id' => 2,
            'address'       =>  '1359 W. 24th St',
            'city'          =>  'Los Angeles',
            'state'         =>  'CA',
            'zipcode'       =>  '90007',
            'country'       =>  'USA'
        ]);

        OrganizationInfo::create([
            'organization_id' => 3,
            'address'       =>  '940 W. Wilshire Ave.',
            'city'          =>  'Santa Ana',
            'state'         =>  'CA',
            'zipcode'       =>  '92707',
            'country'       =>  'USA'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
