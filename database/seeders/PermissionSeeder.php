<?php

namespace Database\Seeders;

// use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Permissões
        Permission::firstOrcreate(['name' => 'access_admin']);
        Permission::firstOrcreate(['name' => 'permission_read']);
        Permission::firstOrcreate(['name' => 'permission_create']);
        Permission::firstOrcreate(['name' => 'permission_updade']);
        Permission::firstOrcreate(['name' => 'permission_delete']);
        // Roles
        Permission::firstOrcreate(['name' => 'role_read']);
        Permission::firstOrcreate(['name' => 'role_create']);
        Permission::firstOrcreate(['name' => 'role_update']);
        Permission::firstOrcreate(['name' => 'role_delete']);
        // User
        Permission::firstOrcreate(['name' => 'user_read']);
        Permission::firstOrcreate(['name' => 'user_create']);
        Permission::firstOrcreate(['name' => 'user_update']);
        Permission::firstOrcreate(['name' => 'user_delete']);
        // logs_view
        Permission::firstOrcreate(['name' => 'logs_view']);
    }
}
