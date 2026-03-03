<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Test route
Route::get('/test-web', function() {
    return response()->json(['message' => 'Web route works!']);
});

// Simple admin route with role middleware
Route::get('/admin', function () {
    return "Admin Dashboard";
})->middleware('role:admin');

// Admin routes group with controllers
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});
