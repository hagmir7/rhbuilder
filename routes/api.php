<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SkillTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/users', function () {
    return User::all();
});


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::put('/user/avatar/{id}', [UserController::class, 'updateAvatar']);
    Route::post('/user/{user}/password', [UserController::class, 'updatePassword']);

    // Roles
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/permissions/{roleName}', [RoleController::class, 'permissions']);

    // Permissions
    Route::post('/permissions', [PermissionController::class, 'store']);
    Route::get('/permissions', [PermissionController::class, 'index']);


    // Assign roles/permissions to users
    Route::post('/users/{user}/roles', [UserPermissionController::class, 'assignRoles']);
    Route::post('/role/{roleName}/permissions', [UserPermissionController::class, 'assignPermissions']);

    // Get user Role and permissions
    Route::get('/user/permissions', [UserPermissionController::class, 'getAuthUserRolesAndPermissions']);
    Route::get('/user/{id}/permissions', [UserPermissionController::class, 'getUserRolesAndPermissions']);
    Route::get('/user/{id}', [AuthController::class, 'show']);



});


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('companies')->controller(CompanyController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('{id}', 'show');
        Route::put('{id}', 'update');
        Route::delete('{id}', 'destroy');
    });


    Route::post('diplomas', [DiplomaController::class, 'store']);
    Route::post('experiences ', [ExperienceController::class, 'store']);


    Route::prefix('resumes')->controller(ResumeController::class)->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
        Route::get('{resume}/diplomes', 'diplomes');
        Route::get('{resume}/experiences', 'experiences');
        Route::get('{resume}/skills', 'skills');
        Route::get('{resume}/languages ', 'languages');
        Route::get('{resume}', 'show');
        Route::put('{resume}', 'update');
    });


     Route::prefix('skills/type')->controller(SkillTypeController::class)->group(function(){
        Route::get('', 'index');
        Route::post('', 'store');
        Route::get('{skill_type}', 'show');
    });

    Route::prefix('skills')->controller(SkillController::class)->group(function(){
        Route::get('', 'index');
        Route::post('resume/store', 'resumeSkillStore');
    });


    Route::apiResource('cities', CityController::class);
    Route::apiResource('levels', LevelController::class);

    Route::prefix('languages')->controller(LanguageController::class)->group(function(){
        Route::post('resume/store', 'resumeLanagueStore');
    });


    Route::apiResource('languages', LanguageController::class);
   
    
});

