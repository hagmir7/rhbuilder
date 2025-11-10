<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CriteriaTypeController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SkillTypeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionController;
use App\Models\Integration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/users', function () {
    return User::all();
});

Route::get('interviews/{interview}/download', [InterviewController::class, 'download']);
Route::get('needs{need}/download', [NeedController::class, 'download']);
Route::get('integrations/{integration}/download', [Integration::class, 'download']);


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

    Route::apiResource('levels', LevelController::class);


    Route::apiResource('departements', DepartementController::class);

    Route::apiResource('services', ServiceController::class);

    Route::apiResource('skills/type', SkillTypeController::class);

    Route::apiResource('skills', SkillController::class);

    Route::apiResource('companies', CompanyController::class);


    Route::apiResource('cities', CityController::class);

    Route::apiResource('categories', CategoryController::class);

    Route::apiResource('languages', LanguageController::class);

    Route::post('diplomas', [DiplomaController::class, 'store']);
    Route::post('experiences ', [ExperienceController::class, 'store']);




    Route::prefix('skills')->controller(SkillController::class)->group(function () {
        Route::get('', 'index');
        Route::post('resume/store', 'resumeSkillStore');
    });




    Route::prefix('languages')->controller(LanguageController::class)->group(function () {
        Route::post('resume/store', 'resumeLanagueStore');
    });

    Route::prefix('resumes')->controller(ResumeController::class)->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
        Route::get('list', 'list');
        Route::get('{resume}/levels', 'levels');
        Route::get('{resume}/experiences', 'experiences');
        Route::get('{resume}/skills', 'skills');
        Route::get('{resume}/languages ', 'languages');
        Route::get('{resume}', 'show');
        Route::put('{resume}', 'update');
        Route::delete('{resume}', 'delete');
        Route::get('{resume}/view', 'view');
        Route::get('{resume}/interviews', 'interviews');
        Route::get('{resume}/invitations', 'invitations');
    });

    Route::prefix('needs')->controller(NeedController::class)->group(function () {
        Route::get('overview', 'overview');
        Route::get('{need}/resumes', 'resumes');
        Route::post('{need}/update-status', 'updateStatus');
        Route::post('{need}/resumes/order', 'updateOrder');
        Route::delete('resume/{need_resume}/delete', 'deleteResume');
        Route::post('invitation/create', 'createNeedInvitation');
        Route::post('invitations/bulk', 'createNeedBulkInvitation');
        Route::get('{need}/download', 'download');
    });
    Route::apiResource('needs', NeedController::class);


    Route::apiResource('invitations', InvitationController::class);
    Route::prefix('invitations')->controller(InvitationController::class)->group(function () {
        Route::put('update-status/{invitation}', 'UpdateStatus');
    });



    Route::apiResource('criteria-types', CriteriaTypeController::class);


    Route::apiResource('templates', TemplateController::class);

    Route::apiResource('interviews', InterviewController::class);

    Route::prefix('interviews')->controller(InterviewController::class)->group(function () {
        Route::post('evaluate-criteria/{interview}', 'evaluateCriteria');
        Route::post('update-type/{interview}', 'updateType');
        Route::post('update-decision/{interview}', 'updateDecision');

    });


    Route::apiResource('posts', PostController::class);

    Route::apiResource('integrations', IntegrationController::class);

    Route::apiResource('integrations', IntegrationController::class);

    Route::prefix('integrations')->controller(IntegrationController::class)->group(function () {
       
    });

    Route::apiResource('activities', ActivityController::class);

    Route::get('/pdf', [PDFController::class, 'editAndPrintPDF']);

    Route::get('calendar', [CalendarController::class, 'calendar']);
});



