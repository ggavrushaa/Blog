<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Posts\CommentController;

Route::view('/', 'home.index')->name('home');

Route::redirect('/home', '/')->name('home.redirect');

// Route::get('/test', TestController::class)->name('test')->middleware('token:secret');
Route::get('/test', TestController::class)->name('test');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::post('blog/{post}/like', [BlogController::class, 'like'])->name('blog.like');

Route::resource('posts/{post}/comments', CommentController::class)->only([
    'index', 'show',
]);

Route::get('character', [CharacterController::class, '__invoke'])->name('character');



Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('panels', [AdminController::class, 'index'])->name('admin.panel');
    Route::delete('panels/delete/{id}', [AdminController::class, 'delete'])->name('admin.panel.delete')->whereNumber('id');
    Route::get('panels/edit/{id}', [AdminController::class, 'edit'])->name('admin.panel.edit')->whereNumber('id');
    Route::put('panels/update/{id}', [AdminController::class, 'update'])->name('admin.panel.update')->whereNumber('id');
    Route::get('panels/user/{id}', [AdminController::class, 'show'])->name('admin.panel.show')->whereNumber('id');
    Route::get('panels/user/create', [AdminController::class, 'create'])->name('admin.panel.create');
    Route::post('panels', [AdminController::class, 'store'])->name('admin.panel.store');

    Route::get('ability', [AbilityController::class, 'index'])->name('ability.index');
    Route::delete('ability/delete', [AbilityController::class, 'delete'])->name('ability.delete');
    Route::get('ability/create', [AbilityController::class, 'create'])->name('ability.create');
    Route::post('ability', [AbilityController::class, 'store'])->name('ability.store');
    Route::get('ability/admin/{id}', [AbilityController::class, 'show'])->name('ability.show');

    Route::get('permissions/create/{user_id}', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/admin/{id}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::delete('permissions/{user}/{permission}', [PermissionController::class, 'delete'])->name('permissions.delete');

    Route::get('roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('roles', [RoleController::class, 'store'])->name('role.store');
    Route::delete('roles/{role}', [RoleController::class, 'delete'])->name('role.delete');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('role.show');
    Route::post('roles/{role}/permissions', [PermissionController::class, 'assignToRole'])->name('role.permissions.assign');
    Route::delete('roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('role.permissions.revoke');
    Route::post('admin/roles/assign/{user}', [RoleController::class, 'assign'])->name('role.assign');
    Route::delete('admin/{user}/role/{role}/revoke', [RoleController::class, 'revoke'])->name('role.revoke');


});


