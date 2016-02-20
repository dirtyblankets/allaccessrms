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
            'name'          =>  "LOLYA"
        ]);

        $org = Organization::create([
            'parent_id'     =>  1,
            'name'          =>  "Sung Kwang Church"
        ]);

        $org = Organization::create([
            'parent_id'     =>  1,
            'name'          =>  "Orange Canaan Presbyterian Church"
        ]);

/*
        DB::table('organizations')->insert([
            'id'            =>  1,
            'parent_id'     =>  null,
            'name'          =>  "All Access",
            'created_at'     => Carbon::now(),
        ]);

        DB::table('organizations')->insert([
            'id'            =>  2,
            'parent_id'     =>  1,
            'name'          =>  "Living Water",
            'created_at'     => Carbon::now(),
        ]);

        DB::table('organizations')->insert([
            'id'            =>  3,
            'parent_id'     =>  1,
            'name'          =>  "Orange Canaan",
            'created_at'     => Carbon::now(),
        ]);

        DB::table('organizations')->insert([
            'id'            =>  4,
            'parent_id'     =>  1,
            'name'          =>  "Sung Kwang",
            'created_at'     => Carbon::now(),
        ]);
*/

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
