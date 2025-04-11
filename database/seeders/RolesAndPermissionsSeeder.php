<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Category management
            'category.manage',
            
            // User management
            'user.list',
            'user.create',
            'user.edit',
            'user.delete',
            
            // Role management
            'role.list',
            'role.create',
            'role.edit',
            'role.delete',
            
            // Permission management
            'permission.list',
            'permission.create',
            'permission.edit',
            'permission.delete',
            
            // Service management
            'service.add',
            
            // Media management
            'media.add',
            
            // Enquiry management
            'enquiry.view',
            
            // Contact management
            'contact.view',
        ];

        // Create or update permissions
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission]
            );
        }

        // Create or update roles
        $adminRole = Role::findOrCreate('admin');
        $managerRole = Role::findOrCreate('manager');
        $userRole = Role::findOrCreate('user');

        // Sync permissions for roles
        $adminRole->syncPermissions(Permission::all());

        $managerRole->syncPermissions([
            'category.manage',
            'user.list',
            'role.list',
            'permission.list',
            'service.add',
            'media.add',
            'enquiry.view',
            'contact.view',
        ]);

        $userRole->syncPermissions([
            'user.list',
            'enquiry.view',
            'contact.view',
        ]);
    }
} 