<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'role_id'=>Role::where('slug','admin')->first()->id,
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
            'is_active'=>1,
            'description'=>'',
        ]);

        User::updateOrCreate([
            'role_id'=>Role::where('slug','trainer')->first()->id,
            'name'=>'Trainer',
            'email'=>'trainer@gmail.com',
            'password'=>Hash::make('password'),
            'is_active'=>1,
            'description'=>'',
        ]);
    }
}
