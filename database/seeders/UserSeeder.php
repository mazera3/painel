<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'document' => '999.999.999-00',
            'password' => Hash::make('123456'),
        ]);
        $role = Role::create(['name' => 'Admin']);
        $user->assignRole($role);

        Role::create(['name' => 'User']);
        User::factory()
            ->count(50)
            ->create()
            ->each(function ($usr) {
                $usr->assignRole('User');
            });
    }
}
