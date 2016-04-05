<?php

use Kodeine\Acl\Models\Eloquent\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production')
        {
            exit('Seed should be run only in development/debug environment.');
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('permissions')->truncate();

        $permission = new Permission();
        $permUser = $permission->create([
            'name'        => 'users',
            'slug'        => [          // pass an array of permissions.
                'create'     => true,
                'view'       => true,
                'update'     => true,
                'delete'     => true
            ],
            'description' => 'manage user permissions'
        ]);

        $permission = new Permission();
        $permUser = $permission->create([
            'name'        => 'events',
            'slug'        => [          // pass an array of permissions.
                'create'     => true,
                'view'       => true,
                'update'     => true,
                'delete'     => true
            ],
            'description' => 'manage event permissions'
        ]);

        $permission = new Permission();
        $permUser = $permission->create([
            'name'        => 'organizations',
            'slug'        => [          // pass an array of permissions.
                'create'     => true,
                'view'       => true,
                'update'     => true,
                'delete'     => true
            ],
            'description' => 'manage organization permissions'
        ]);

        $permission = new Permission();
        $permUser = $permission->create([
            'name'        => 'attendees',
            'slug'        => [          // pass an array of permissions.
                'create'     => true,
                'view'       => true,
                'update'     => true,
                'delete'     => true
            ],
            'description' => 'manage attendee permissions'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
