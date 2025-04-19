<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemMasterController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::get('/my-profile', [AdminController::class, 'myProfile'])->name('myProfile');
        Route::put('/update-profile', [AdminController::class, 'updateProfile'])->name('updateProfile');

        // check permission middelwere
        // Route::middleware(['check.permission:manage category'])->group(function () {
        // });
        Route::get('categories/export', [CategoryController::class, 'export'])->name('categories.export');
        Route::resource('categories', CategoryController::class);

        Route::get('/roles/export', [RoleController::class, 'export'])->name('roles.export');
        Route::get('/roles/{roleId}/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assignPermissions');
        Route::post('/roles/{roleId}/assign-permissions', [RoleController::class, 'storeAssignedPermissions'])->name('roles.storeAssignedPermissions');
        Route::resource('roles', RoleController::class);

        Route::get('/permissions/export', [PermissionController::class, 'export'])->name('permissions.export');
        Route::resource('permissions', PermissionController::class);
    });
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/export', [UserController::class, 'export'])->name('export');
        Route::get('/', [UserController::class, 'index'])->name('index');

        // Create user
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');

        // View user
        Route::get('/{user}', [UserController::class, 'show'])->name('show');

        // Edit user
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');

        // Delete user
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

        // User permissions
        Route::get('/{user}/permissions', [UserController::class, 'permissions'])->name('permissions');
        Route::put('/{user}/permissions', [UserController::class, 'updatePermissions'])->name('updatePermissions');
    });
    Route::resource('/admin/items', ItemMasterController::class);
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('companies', CompanyController::class);
        Route::resource('branches', BranchController::class);
    });
    Route::get('companies/export-excel', [CompanyController::class, 'exportExcel'])->name('admin.companies.export');

    Route::resource('vendors', VendorController::class);
    // User profile routes
    Route::prefix('profile')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
        Route::put('/', [UserController::class, 'updateProfile'])->name('updateProfile');
    });

    // Other admin routes
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/upload-video', [AdminController::class, 'uploadVideo'])->name('admin.uploadVideo');
    Route::post('/admin/store-info', [AdminController::class, 'storeInfo'])->name('admin.storeInfo');
    Route::get('/admin/show-info', [AdminController::class, 'showInfo'])->name('admin.showInfo');

    // Admin Profile Routes
    Route::get('/admin/my-profile', [AdminController::class, 'myProfile'])->name('admin.myProfile');
    Route::put('/admin/update-profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
});