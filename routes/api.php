<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserPermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){

        // Roles
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/permissions/{roleName}', [RoleController::class, 'permissions']);

    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::post('/permissions', [PermissionController::class, 'store']);

    // Assign roles/permissions to users
    Route::post('/users/{user}/roles', [UserPermissionController::class, 'assignRoles']);
    Route::post('/role/{roleName}/permissions', [UserPermissionController::class, 'assignPermissions']);

    // Get user Role and permissions
    Route::get('/user/{id}/permissions', [UserPermissionController::class, 'getUserRolesAndPermissions']);
    Route::get('/user/permissions', [UserPermissionController::class, 'getAuthUserRolesAndPermissions']);

});