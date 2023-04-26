<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admins']);
        $roleReseller = Role::create(['name' => 'resellers']);
        $roleMember = Role::create(['name' => 'members']);

        $permissionDashboardAdmin = Permission::create(['name' => 'dashboard.admin']);
        $permissionDashboardReseller = Permission::create(['name' => 'dashboard.reseller']);
        $permissionDashboardMember = Permission::create(['name' => 'dashboard.member']);

        $roleAdmin->givePermissionTo($permissionDashboardAdmin);
        $roleReseller->givePermissionTo($permissionDashboardReseller);
        $roleMember->givePermissionTo($permissionDashboardMember);
    }
}
