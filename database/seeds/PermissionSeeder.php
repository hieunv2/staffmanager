<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $superAdminRole = Role::create(['name' => 'super_admin', 'display_name' => 'Quản trị cấp cao', 'level' => 10, 'guard_name' => 'api']);
        $adminRole = Role::create(['name' => 'admin', 'display_name' => 'Quản trị viên', 'level' => 9, 'guard_name' => 'api']);

        // Permissions
        $superAdminPermission = Permission::create(['name' => 'super_admin', 'display_name' => 'Quản lý quản trị viên', 'guard_name' => 'api']);
        $systemFeaturesPermission = Permission::create(['name' => 'admin', 'display_name' => 'Quản lý các chức năng hệ thống', 'guard_name' => 'api']);

        $superAdminRole->givePermissionTo($superAdminPermission, $systemFeaturesPermission);
        $adminRole->givePermissionTo($systemFeaturesPermission);
    }
}
