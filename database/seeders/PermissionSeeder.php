<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleappdashboard=Module::updateOrCreate(['name'=>'Admin Dashboard']);

        Permission::updateOrCreate([
            'module_id'=>$moduleappdashboard->id,
            'name'=>'Access Dashboard',
            'slug'=>'home',
        ]);

        $moduleAppRole=Module::updateOrCreate(['name'=>'Role Managment']);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Access Role',
            'slug'=>'roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Create Role',
            'slug'=>'roles.create',
        ]);

        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Edit Role',
            'slug'=>'roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Delete Role',
            'slug'=>'roles.destroy',
        ]);

        $moduleAppuser=Module::updateOrCreate(['name'=>'User Managment']);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppuser->id,
            'name'=>'Access User',
            'slug'=>'users.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppuser->id,
            'name'=>'Create Users',
            'slug'=>'users.create',
        ]);

        Permission::updateOrCreate([
            'module_id'=>$moduleAppuser->id,
            'name'=>'Edit User',
            'slug'=>'users.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppuser->id,
            'name'=>'Delete User',
            'slug'=>'users.destroy',
        ]);

    }
}
