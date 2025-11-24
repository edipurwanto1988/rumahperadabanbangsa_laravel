<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ActivityLogController;

// Admin routes group
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        
        // Redirect /admin to /admin/dashboard
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard')
            ->middleware('permission:dashboard.view');

        // Activity Logs
        Route::resource('activity-logs', ActivityLogController::class)
            ->only(['index'])
            ->middleware('permission:activity-logs.view');
        
        // Image Upload
        Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');
        
        // User Management
        Route::prefix('users')
            ->name('users.')
            ->middleware('permission:users.view')
            ->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('permission:users.create');
                Route::post('/', [UserController::class, 'store'])->name('store')->middleware('permission:users.create');
                Route::get('/{user}', [UserController::class, 'show'])->name('show')->middleware('permission:users.view');
                Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit')->middleware('permission:users.edit');
                Route::put('/{user}', [UserController::class, 'update'])->name('update')->middleware('permission:users.edit');
                Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy')->middleware('permission:users.delete');
            });
        
        // Role Management
        Route::prefix('roles')
            ->name('roles.')
            ->middleware('permission:roles.view')
            ->group(function () {
                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::get('/create', [RoleController::class, 'create'])->name('create')->middleware('permission:roles.create');
                Route::post('/', [RoleController::class, 'store'])->name('store')->middleware('permission:roles.create');
                Route::get('/{role}', [RoleController::class, 'show'])->name('show')->middleware('permission:roles.view');
                Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit')->middleware('permission:roles.edit');
                Route::put('/{role}', [RoleController::class, 'update'])->name('update')->middleware('permission:roles.edit');
                Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy')->middleware('permission:roles.delete');
            });
        
        // Permission Management
        Route::prefix('permissions')
            ->name('permissions.')
            ->middleware('permission:permissions.view')
            ->group(function () {
                Route::get('/', [PermissionController::class, 'index'])->name('index');
                Route::get('/create', [PermissionController::class, 'create'])->name('create')->middleware('permission:permissions.create');
                Route::post('/', [PermissionController::class, 'store'])->name('store')->middleware('permission:permissions.create');
                Route::get('/{permission}', [PermissionController::class, 'show'])->name('show')->middleware('permission:permissions.view');
                Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('edit')->middleware('permission:permissions.edit');
                Route::put('/{permission}', [PermissionController::class, 'update'])->name('update')->middleware('permission:permissions.edit');
                Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy')->middleware('permission:permissions.delete');
            });
        
        // Menu Management
        Route::prefix('menus')
            ->name('menus.')
            ->middleware('permission:menus.view')
            ->group(function () {
                Route::get('/', [MenuController::class, 'index'])->name('index');
                Route::get('/create', [MenuController::class, 'create'])->name('create')->middleware('permission:menus.create');
                Route::post('/', [MenuController::class, 'store'])->name('store')->middleware('permission:menus.create');
                Route::get('/{menu}', [MenuController::class, 'show'])->name('show')->middleware('permission:menus.view');
                Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit')->middleware('permission:menus.edit');
                Route::put('/{menu}', [MenuController::class, 'update'])->name('update')->middleware('permission:menus.edit');
                Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy')->middleware('permission:menus.delete');
                Route::post('/reorder', [MenuController::class, 'reorder'])->name('reorder');
                Route::get('/tree/data', [MenuController::class, 'tree'])->name('tree');
                Route::post('/{menu}/toggle', [MenuController::class, 'toggle'])->name('toggle');
            });

        // Settings Management
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index')->middleware('permission:settings.view');
        Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update')->middleware('permission:settings.edit');
        
        // Posts Management
        Route::prefix('posts')
            ->name('posts.')
            ->middleware('permission:posts.view')
            ->group(function () {
                Route::get('/', [PostController::class, 'index'])->name('index');
                Route::get('/create', [PostController::class, 'create'])->name('create')->middleware('permission:posts.create');
                Route::post('/', [PostController::class, 'store'])->name('store')->middleware('permission:posts.create');
                Route::get('/{post}', [PostController::class, 'show'])->name('show')->middleware('permission:posts.view');
                Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit')->middleware('permission:posts.edit');
                Route::put('/{post}', [PostController::class, 'update'])->name('update')->middleware('permission:posts.edit');
                Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy')->middleware('permission:posts.delete');
            });
        
        // Categories Management
        Route::prefix('categories')
            ->name('categories.')
            ->middleware('permission:categories.view')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('permission:categories.create');
                Route::post('/', [CategoryController::class, 'store'])->name('store')->middleware('permission:categories.create');
                Route::post('/ajax', [CategoryController::class, 'storeAjax'])->name('storeAjax')->middleware('permission:categories.create');
                Route::get('/{category}', [CategoryController::class, 'show'])->name('show')->middleware('permission:categories.view');
                Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit')->middleware('permission:categories.edit');
                Route::put('/{category}', [CategoryController::class, 'update'])->name('update')->middleware('permission:categories.edit');
                Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:categories.delete');
            });
        
        // Pages Management
        Route::prefix('pages')
            ->name('pages.')
            ->middleware('permission:pages.view')
            ->group(function () {
                Route::get('/', [PageController::class, 'index'])->name('index');
                Route::get('/create', [PageController::class, 'create'])->name('create')->middleware('permission:pages.create');
                Route::post('/', [PageController::class, 'store'])->name('store')->middleware('permission:pages.create');
                Route::get('/{page}', [PageController::class, 'show'])->name('show')->middleware('permission:pages.view');
                Route::get('/{page}/edit', [PageController::class, 'edit'])->name('edit')->middleware('permission:pages.edit');
                Route::put('/{page}', [PageController::class, 'update'])->name('update')->middleware('permission:pages.edit');
                Route::delete('/{page}', [PageController::class, 'destroy'])->name('destroy')->middleware('permission:pages.delete');
            });
        
        // Profile Management
        Route::prefix('profile')
            ->name('profile.')
            ->group(function () {
                Route::get('/', [ProfileController::class, 'index'])->name('index');
                Route::put('/', [ProfileController::class, 'update'])->name('update');
            });
        
});