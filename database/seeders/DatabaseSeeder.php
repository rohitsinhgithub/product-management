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
        // Call our main roles and permissions seeder first
        $this->call(RolesAndPermissionsSeeder::class);
        
        // Create super admin user
        $user = User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('123456'),
            ]
        );
        
        // Assign all permissions to super admin
        if ($adminRole = Role::where('name', 'admin')->first()) {
            $user->assignRole($adminRole);
        }

        // Create default permissions
        $this->call(DefaultPermissionsSeeder::class);
        
        // Create user module permissions
        $this->call(UserModulePermissionsSeeder::class);
        
        // Call the seeder to assign all permissions to user_id 3
        $this->call(AssignPermissionsToUserSeeder::class);
    }
}
