<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define default permissions
        $permissions = [
            // Role management permissions
            'manage role',
            'view roles',
            'create role',
            'edit role',
            'delete role',
            'assign permissions',
            
            // Permission management permissions
            'manage permission',
            'view permissions',
            'create permission',
            'edit permission',
            'delete permission',
            
            // Category management permissions
            'manage category',
            'view categories',
            'create category',
            'edit category',
            'delete category',
            
            // Admin permissions
            'access admin',
            'upload video',
            'store info',
            'view info',
            
            // User management permissions
            'manage users',
            'view users',
            'create user',
            'edit user',
            'delete user',
            
            // General permissions
            'view dashboard',
            'manage settings',
        ];
        
        // Create each permission
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
        
        $this->command->info('Default permissions created successfully!');
    }
}
