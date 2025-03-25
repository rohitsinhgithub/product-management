<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/upload-video', [AdminController::class, 'uploadVideo'])->name('admin.uploadVideo');
    Route::post('/admin/store-info', [AdminController::class, 'storeInfo'])->name('admin.storeInfo');
    Route::get('/admin/show-info', [AdminController::class, 'showInfo'])->name('admin.showInfo');

    Route::prefix('/admin')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name("admin_dashboard");
        Route::get('/clear-pages-cache', 'clearPagesCache')->name('clear-pages-cache');
        Route::get('/my-profile', 'myProfile')->name("my-profile");
        Route::post('/my-profile/Profile picture', 'profilePicRemove')->name("profile_pic_remove");
        Route::post('/update-profile', 'updateProfile')->name("update-profile");
        Route::get('/change-password', 'changePassword')->name("change-password");
        Route::post('/changePassword/data', 'changePasswordData')->name("change-password-data");
    });
    Route::prefix('/admin')->controller(ContactUsController::class)->group(function () {
        Route::get('/contactus', 'index')->name("admin_contactus");
    });
    Route::prefix('/admin')->controller(ContactUsController::class)->group(function () {
        Route::get('/enquiry', 'index')->name("enquiry.index");
        Route::get('/enquiry/data', 'data')->name("enquiry.data");
        Route::get('/enquiry/show/{id}', 'show')->name("enquiry.show");
        Route::get('/enquiry/latest', 'showlatest')->name("enquiry.latest");
    });
});