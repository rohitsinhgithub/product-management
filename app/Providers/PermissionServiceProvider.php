<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Define permission constants
        if (!defined('PERMISSION_MANAGE_CATEGORIES')) {
            define('PERMISSION_MANAGE_CATEGORIES', 'manage categories');
        }
        
        if (!defined('PERMISSION_MANAGE_ROLES')) {
            define('PERMISSION_MANAGE_ROLES', 'manage role');
        }
        
        if (!defined('PERMISSION_MANAGE_PERMISSIONS')) {
            define('PERMISSION_MANAGE_PERMISSIONS', 'manage permission');
        }
        
        if (!defined('PERMISSION_USER_LIST')) {
            define('PERMISSION_USER_LIST', 'user.list');
        }
        
        if (!defined('PERMISSION_USER_VIEW')) {
            define('PERMISSION_USER_VIEW', 'user.view');
        }
        
        if (!defined('PERMISSION_USER_CREATE')) {
            define('PERMISSION_USER_CREATE', 'user.create');
        }
        
        if (!defined('PERMISSION_USER_EDIT')) {
            define('PERMISSION_USER_EDIT', 'user.edit');
        }
        
        if (!defined('PERMISSION_USER_DELETE')) {
            define('PERMISSION_USER_DELETE', 'user.delete');
        }
        
        if (!defined('PERMISSION_USER_PROFILE')) {
            define('PERMISSION_USER_PROFILE', 'user.profile');
        }
        
        if (!defined('PERMISSION_USER_PERMISSIONS')) {
            define('PERMISSION_USER_PERMISSIONS', 'user.permissions');
        }
        
        if (!defined('PERMISSION_ADD_SERVICE')) {
            define('PERMISSION_ADD_SERVICE', 'add service');
        }
        
        if (!defined('PERMISSION_ADD_PHOTO')) {
            define('PERMISSION_ADD_PHOTO', 'add photo');
        }
        
        if (!defined('PERMISSION_VIEW_ENQUIRIES')) {
            define('PERMISSION_VIEW_ENQUIRIES', 'view enquiries');
        }
        
        if (!defined('PERMISSION_VIEW_CONTACT')) {
            define('PERMISSION_VIEW_CONTACT', 'view contact');
        }
        
        // Register permission gates
        Gate::define(PERMISSION_MANAGE_CATEGORIES, function ($user) {
            return $user->hasPermissionTo(PERMISSION_MANAGE_CATEGORIES);
        });
        
        Gate::define(PERMISSION_MANAGE_ROLES, function ($user) {
            return $user->hasPermissionTo(PERMISSION_MANAGE_ROLES);
        });
        
        Gate::define(PERMISSION_MANAGE_PERMISSIONS, function ($user) {
            return $user->hasPermissionTo(PERMISSION_MANAGE_PERMISSIONS);
        });
        
        Gate::define(PERMISSION_USER_LIST, function ($user) {
            return $user->hasPermissionTo(PERMISSION_USER_LIST);
        });
        
        Gate::define(PERMISSION_USER_VIEW, function ($user) {
            return $user->hasPermissionTo(PERMISSION_USER_VIEW);
        });
        
        Gate::define(PERMISSION_USER_CREATE, function ($user) {
            return $user->hasPermissionTo(PERMISSION_USER_CREATE);
        });
        
        Gate::define(PERMISSION_USER_EDIT, function ($user) {
            return $user->hasPermissionTo(PERMISSION_USER_EDIT);
        });
        
        Gate::define(PERMISSION_USER_DELETE, function ($user) {
            return $user->hasPermissionTo(PERMISSION_USER_DELETE);
        });
        
        Gate::define(PERMISSION_USER_PROFILE, function ($user) {
            return $user->hasPermissionTo(PERMISSION_USER_PROFILE);
        });
        
        Gate::define(PERMISSION_USER_PERMISSIONS, function ($user) {
            return $user->hasPermissionTo(PERMISSION_USER_PERMISSIONS);
        });
        
        Gate::define(PERMISSION_ADD_SERVICE, function ($user) {
            return $user->hasPermissionTo(PERMISSION_ADD_SERVICE);
        });
        
        Gate::define(PERMISSION_ADD_PHOTO, function ($user) {
            return $user->hasPermissionTo(PERMISSION_ADD_PHOTO);
        });
        
        Gate::define(PERMISSION_VIEW_ENQUIRIES, function ($user) {
            return $user->hasPermissionTo(PERMISSION_VIEW_ENQUIRIES);
        });
        
        Gate::define(PERMISSION_VIEW_CONTACT, function ($user) {
            return $user->hasPermissionTo(PERMISSION_VIEW_CONTACT);
        });
    }
} 