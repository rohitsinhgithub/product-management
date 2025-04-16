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
        $permissions = Permission::all();
        $user = User::find(1);
        foreach ($permissions as $permission) {
            $user->givePermissionTo($permission->name);
        }
        
        $this->command->info('All permissions assigned to super admin user successfully!');
    }
}
