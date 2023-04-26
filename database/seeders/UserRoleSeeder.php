<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('admins');

        $resellers = User::create([
            'name' => 'Resellers',
            'email' => 'resellers@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('resellers');

        $members = User::create([
            'name' => 'Members',
            'email' => 'members@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('members');
    }
}
