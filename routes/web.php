<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemMasterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Profile routes
        Route::get('/my-profile', [AdminController::class, 'myProfile'])->name('myProfile');
        Route::put('/update-profile', [AdminController::class, 'updateProfile'])->name('updateProfile');
        
        // Category routes
        Route::middleware(['check.permission:manage category'])->group(function () {
        });
        Route::get('categories/export', [CategoryController::class, 'export'])->name('categories.export');
        Route::resource('categories', CategoryController::class);
        
        // Role management routes
        Route::middleware(['check.permission:role_list'])->group(function () {
        });
        Route::get('/roles/export', [RoleController::class, 'export'])->name('roles.export');
        Route::get('/roles/{roleId}/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assignPermissions');
        Route::post('/roles/{roleId}/assign-permissions', [RoleController::class, 'storeAssignedPermissions'])->name('roles.storeAssignedPermissions');
        Route::resource('roles', RoleController::class);    
        
        // Permission management routes
        Route::middleware(['check.permission:permission_list'])->group(function () {
        });
        Route::get('/permissions/export', [PermissionController::class, 'export'])->name('permissions.export');
        Route::resource('permissions', PermissionController::class);
    });
    
    // User management routes - consolidated and fixed
    Route::prefix('users')->name('users.')->group(function () {
        // Export users (moved to top)
        Route::get('/export', [UserController::class, 'export'])->middleware('check.permission:user.list')->name('export');
        
        // List users
        Route::get('/', [UserController::class, 'index'])->middleware('check.permission:user.list')->name('index');
        
        // Create user
        Route::get('/create', [UserController::class, 'create'])->middleware('check.permission:user.create')->name('create');
        Route::post('/', [UserController::class, 'store'])->middleware('check.permission:user.create')->name('store');
        
        // View user
        Route::get('/{user}', [UserController::class, 'show'])->middleware('check.permission:user.view')->name('show');
        
        // Edit user
        Route::get('/{user}/edit', [UserController::class, 'edit'])->middleware('check.permission:user.edit')->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->middleware('check.permission:user.edit')->name('update');
        
        // Delete user
        Route::delete('/{user}', [UserController::class, 'destroy'])->middleware('check.permission:user.delete')->name('destroy');
        
        // User permissions
        Route::get('/{user}/permissions', [UserController::class, 'permissions'])->middleware('check.permission:user.permissions')->name('permissions');
        Route::put('/{user}/permissions', [UserController::class, 'updatePermissions'])->middleware('check.permission:user.permissions')->name('updatePermissions');
    });
    
    // User profile routes
    Route::prefix('profile')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->middleware('check.permission:user.profile')->name('profile');
        Route::put('/', [UserController::class, 'updateProfile'])->middleware('check.permission:user.profile')->name('updateProfile');
    });
    
    // Other admin routes
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/upload-video', [AdminController::class, 'uploadVideo'])->name('admin.uploadVideo');
    Route::post('/admin/store-info', [AdminController::class, 'storeInfo'])->name('admin.storeInfo');
    Route::get('/admin/show-info', [AdminController::class, 'showInfo'])->name('admin.showInfo');
    
    // Admin Profile Routes
    Route::get('/admin/my-profile', [AdminController::class, 'myProfile'])->name('admin.myProfile');
    Route::put('/admin/update-profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');

    // Roles export route
});