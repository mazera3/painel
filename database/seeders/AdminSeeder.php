<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // $SuperAdmin = User::find(1);
        // $SuperAdmin->save();

        $admin = User::firstOrcreate([
            'id'        => 2,
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole('Admin');

        // $admin = Role::where('name', 'Admin')->first();
        // $admin->givePermissionTo([

        $admin = Role::where('name', 'Admin')->first()->givePermissionTo([
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
        $manager = User::firstOrcreate([
            'id'        => 3,
            'name'      => 'Gerente',
            'email'     => 'gerente@gerente.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $manager = Role::where('name', 'Manager')->first();
        $manager->givePermissionTo([
            'access_admin',
            'user_read',
            'user_create',
            'user_update',
            'user_delete',
        ])->assignRole('Manager');
        // $manager->assignRole('Manager');

        // Usuário
        $user = User::firstOrcreate([
            'id'        => 4,
            'name'      => 'Usuario',
            'email'     => 'user@user.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user = Role::where('name', 'User')->first();
        $user->givePermissionTo([
            'access_admin',
        ])->assignRole('User');
        // $user->assignRole('User');

        // Convidado
        $gest = User::firstOrcreate([
            'id'        => 5,
            'name'      => 'Convidado',
            'email'     => 'gest@gest.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ])->assignRole('Gest');
        $gest = Role::where('name', 'Gest')->first();
        $gest->givePermissionTo([]);
        // $gest->assignRole('Gest');
    }
}
