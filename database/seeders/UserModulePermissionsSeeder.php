<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define user module permissions
        $permissions = [
            // User management permissions
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'user.list',
            'user.export',
            'user.import',
            'user.profile',
            'user.settings',
            'user.permissions'
        ];
        
        // Create each permission
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission]
            );
        }
        
        $this->command->info('User module permissions created successfully!');
    }
}
