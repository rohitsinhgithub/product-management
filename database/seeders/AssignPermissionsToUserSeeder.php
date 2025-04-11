<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AssignPermissionsToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all permissions
        $permissions = Permission::all();
        
        // Find user with ID 3
        $user = User::find(1);
        
        // Assign all permissions to the user
        foreach ($permissions as $permission) {
            $user->givePermissionTo($permission->name);
        }
        
        $this->command->info('All permissions assigned to super admin user successfully!');
    }
}
