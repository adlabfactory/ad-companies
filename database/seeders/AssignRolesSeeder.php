<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AssignRolesSeeder extends Seeder
{
   
    public function run()
    {
        // Assigner le rôle 'super-admin' à l'utilisateur avec l'ID 1
        $user = User::find(30);
        $user->assignRole('super-admin'); // Assigne le rôle "super-admin"

        // Assigner le rôle 'admin' à l'utilisateur avec l'ID 2
        $admin = User::find(28);
        $admin->assignRole('admin'); // Assigne le rôle "admin"
    }
}
