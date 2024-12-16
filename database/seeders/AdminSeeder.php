<?php

namespace Database\Seeders;

// use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $SuperAdmin = User::firstOrCreate([
            'id'        => 1,
            'name'      => 'SuperAdmin',
            'email'     => 'super@admin.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $SuperAdmin->assignRole('Admin');
        $SuperAdmin = Role::where('name', 'Admin')->first()->syncPermissions([
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
        ]);
        // Admin
        $admin = User::firstOrCreate([
            'id'        => 2,
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole('Admin');

        $admin = Role::where('name', 'Admin')->first()->syncPermissions([
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
        ]);

        // Gerente
        $manager = User::firstOrCreate([
            'id'        => 3,
            'name'      => 'Gerente',
            'email'     => 'gerente@gerente.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $manager->assignRole('Manager');

        $manager = Role::where('name', 'Manager')->first()->syncPermissions([
            'access_admin',
            'user_read',
            'user_create',
            'user_update',
            'user_delete',
        ]);

        // Usuário
        $user = User::firstOrCreate([
            'id'        => 4,
            'name'      => 'Usuario',
            'email'     => 'user@user.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('User');

        $user = Role::where('name', 'User')->first()->syncPermissions([
            'access_admin',
        ]);



        // Convidado
        $gest = User::firstOrcreate([
            'id'        => 5,
            'name'      => 'Convidado',
            'email'     => 'gest@gest.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $gest->assignRole('Gest');

        $gest = Role::where('name', 'Gest')->first()->syncPermissions([]);
        // $gest->assignRole('Gest');
    }
}
