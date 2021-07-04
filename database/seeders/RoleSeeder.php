<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions=Permission::all();
        Role::updateOrCreate([
            'name'=>'Admin',
            'slug'=>'admin',
            'description'=>'This is Admin',
            'delteable'=>false,

        ])->permissions()->sync($adminPermissions->pluck('id'));

        Role::updateOrCreate([
            'name'=>'Trainer',
            'slug'=>'trainer',
            'description'=>'This is Trainer',
            'delteable'=>false,

        ]);
    }
}
