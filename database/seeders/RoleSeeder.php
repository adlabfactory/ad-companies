<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Créer des permissions
        $permissionSeeAdmins = Permission::create(['name' => 'see all admins']);
        $permissionEditAdmins = Permission::create(['name' => 'edit admins']);

        // Créer les rôles
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);

        // Assigner des permissions aux rôles
        $superAdminRole->givePermissionTo($permissionSeeAdmins);
        $superAdminRole->givePermissionTo($permissionEditAdmins);
        
        $adminRole->givePermissionTo($permissionEditAdmins);
    }
}


