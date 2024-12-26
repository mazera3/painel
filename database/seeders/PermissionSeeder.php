<?php

namespace Database\Seeders;

// use App\Models\Permission;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        //************************ Admin ****************************** */
        // Cria sa regras
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleManager = Role::create(['name' => 'Manager']);
        $roleUser = Role::create(['name' => 'User']);
        $roleGest = Role::create(['name' => 'Gest']);

        // Ctia as permissões
        $permissions = [
            'access_admin',
            'permission_read',
            'permission_create',
            'permission_updade',
            'permission_delete',
            'role_read',
            'role_create',
            'role_update',
            'role_delete',
            'user_read',
            'user_create',
            'user_update',
            'user_delete',
            'logs_view'
        ];
        // Cria sa permissões
        foreach ($permissions as $permission) {
            Permission::Create(['name' => $permission]);
        };

        // Cria Admin
        $Admin = User::Create([
            'id'        => 1,
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'document'     => '999.999.999-01',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        // Adiciona regra a user admin
        $Admin->assignRole('Admin');
        // Sincroniza permissoes a regra
        $roleAdmin->syncPermissions($permissions);

        //*********************** Manager ******************************* */
        // Cria Manager
        $Manager = User::Create([
            'id'        => 2,
            'name'      => 'Gerente',
            'email'     => 'gerente@gerente.com',
            'document'     => '999.999.999-02',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        // Adiciona regra a user Manager
        $Manager->assignRole('Manager');
        $permissionsMageger = [
            'access_admin',
            'user_read',
            'user_create',
            'user_update',
            'user_delete',
        ];
        // Sincroniza permissoes a regra
        $roleManager->syncPermissions($permissionsMageger);

        //************************ User ************************************** */

        $User = User::Create([
            'id'        => 3,
            'name'      => 'Usuario',
            'email'     => 'user@user.com',
            'document'     => '999.999.999-03',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Adiciona regra a user User
        $User->assignRole('User');
        $permissionsUser = [
            'access_admin',
        ];
        // Sincroniza permissoes a regra
        $roleUser->syncPermissions($permissionsUser);

        //************************ Gest ************************************** */

        $Gest = User::Create([
            'id'        => 4,
            'name'      => 'Convidado',
            'email'     => 'gest@gest.com',
            'document'     => '999.999.999-04',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        // Adiciona regra a user Gest
        $Gest->assignRole('Gest');
        $permissionsGest = [];
        // Sincroniza permissoes a regra
        $roleGest->syncPermissions($permissionsGest);
    }
}
