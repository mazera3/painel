<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrcreate(['name' => 'Admin']);
        Role::firstOrcreate(['name' => 'Manager']);
        Role::firstOrcreate(['name' => 'User']);
        Role::firstOrcreate(['name' => 'Gest']);
    }
}
