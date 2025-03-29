<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Role::create(['name' => 'super admin']);
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'manager']);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin2@example.com',
            'password' => bcrypt('password123'),  // Change this to a secure password
        ]);
        $user->assignRole('super admin');
    }
}
