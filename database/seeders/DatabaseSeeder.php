<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        $this->call([
            // PermissionSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            CategorySeeder::class,
        ]);
        
    }
}
// php artisan db:seed