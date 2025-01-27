<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Créer les rôles
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $adminRole = Role::create(['name' => 'Admin']);

        // Créer les permissions
        Permission::create(['name' => 'manage admins']); // Pour le Super Admin
        Permission::create(['name' => 'manage own data']); // Pour les Admins
        Permission::create(['name' => 'manage permissions']); // Pour le Super Admin
        Permission::create(['name' => 'manage roles']); // Pour le Super Admin

        // Attribuer les permissions aux rôles
        $superAdminRole->givePermissionTo(['manage admins', 'manage permissions', 'manage roles']);
        $adminRole->givePermissionTo('manage own data');
    }
}