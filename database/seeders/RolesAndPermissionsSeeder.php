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
            'category.manage',
            
            'user.list',
            'user.create',
            'user.edit',
            'user.delete',
            
            'role.list',
            'role.create',
            'role.edit',
            'role.delete',
            
            'permission.list',
            'permission.create',
            'permission.edit',
            'permission.delete',
            
        ];

        // Create or update permissions
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission]
            );
        }

        // Create or update roles
        $superadminRole = Role::findOrCreate('superadmin');
        $adminRole = Role::findOrCreate('admin');
        $managerRole = Role::findOrCreate('manager');

        // Sync permissions for roles
        $superadminRole->syncPermissions(Permission::all());

        $adminRole->syncPermissions([
            'category.manage',
            'user.list',
            'role.list',
            'permission.list',
            'service.add',
            'media.add',
            'enquiry.view',
            'contact.view',
        ]);

        $managerRole->syncPermissions([
            'user.list',
            'enquiry.view',
            'contact.view',
        ]);
    }
} 