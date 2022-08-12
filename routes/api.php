<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiCarController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiBrandController;
use App\Http\Controllers\Api\ApiPackageController;
use App\Http\Controllers\Api\ApiTransmissionController;
use App\Http\Controllers\Api\Student\ApiStudentController;
use App\Http\Controllers\Api\Admin\ApiAdminCourseController;
use App\Http\Controllers\Api\Student\ApiStudentCarController;
use App\Http\Controllers\Api\Admin\ApiAdminInstructorController;
use App\Http\Controllers\Api\Instructor\ApiInstructorController;
use App\Http\Controllers\Api\Student\ApiStudentCourseController;
use App\Http\Controllers\Api\Student\ApiStudentPackageController;
use App\Http\Controllers\Api\Instructor\ApiInstructorCourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authorization
Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);

// Transmission
Route::get('/transmission', [ApiTransmissionController::class, 'showAll']);

// Brand
Route::get('/brand', [ApiBrandController::class, 'showAll']);
Route::get('/brand/{brand}', [ApiBrandController::class, 'show']);

// Package
Route::get('/package', [ApiPackageController::class, 'showAll']);
Route::get('/package/{package}', [ApiPackageController::class, 'show']);

// Car
Route::get('/car', [ApiCarController::class, 'showAll']);
Route::get('/car/{car}', [ApiCarController::class, 'show']);

// Route that must be authorized
Route::middleware('auth:sanctum')->group(function() {
    // Authorization
    Route::get('/profile', [ApiAuthController::class, 'profile']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);

    // MIddleware isAdmin
    Route::middleware('isAdmin')->group(function() {
        // Brand
        Route::post('/brand/create', [ApiBrandController::class, 'create']);
        Route::put('/brand/{brand}/edit', [ApiBrandController::class, 'edit']);
        Route::delete('/brand/{brand}/delete', [ApiBrandController::class, 'delete']);
    
        // Package
        Route::post('/package/create', [ApiPackageController::class, 'create']);
        Route::put('/package/{package}/edit', [ApiPackageController::class, 'edit']);
        Route::delete('/package/{package}/delete', [ApiPackageController::class, 'delete']);
        
        // Car
        Route::post('/car/create', [ApiCarController::class, 'create']);
        Route::put('/car/{car}/edit', [ApiCarController::class, 'edit']);
        Route::delete('/car/{car}/delete', [ApiCarController::class, 'delete']);

        // Course
        Route::get('/admin/payment', [ApiAdminCourseController::class, 'showAllPayment']);
        Route::get('/admin/payment/{course}', [ApiAdminCourseController::class, 'showPayment']);
        Route::put('/admin/payment/{course}/confirm', [ApiAdminCourseController::class, 'confirm']);

        // Instructor
        Route::get('/admin/instructor', [ApiAdminInstructorController::class, 'showAll']);
        Route::post('/admin/instructor/create', [ApiAdminInstructorController::class, 'create']);
        Route::get('/admin/instructor/{instructor}', [ApiAdminInstructorController::class, 'show']);
        Route::put('/admin/instructor/{instructor}/edit', [ApiAdminInstructorController::class, 'edit']);
        Route::delete('/admin/instructor/{instructor}/delete', [ApiAdminInstructorController::class, 'delete']);
    });

    // Middleware student
    Route::middleware('isStudent')->group(function() {
        
        // Profile
        Route::put('/student/profile', [ApiStudentController::class, 'profile']);

        // Car
        Route::get('/student/car', [ApiStudentCarController::class, 'showAll']);
        Route::post('/student/car/create', [ApiStudentCarController::class, 'create']);
        Route::get('/student/car/{car}', [ApiStudentCarController::class, 'show']);
        Route::put('/student/car/{car}/edit', [ApiStudentCarController::class, 'edit']);
        Route::delete('/student/car/{car}/delete', [ApiStudentCarController::class, 'delete']);

        // Package
        Route::get('/student/package', [ApiStudentPackageController::class, 'showAll']);
        Route::get('/student/package/{package}', [ApiStudentPackageController::class, 'show']);

        // Course
        Route::get('/student/course', [ApiStudentCourseController::class, 'showAll']);
        Route::post('/student/course/enroll', [ApiStudentCourseController::class, 'enroll']);
        Route::put('/student/course/{course}/pay', [ApiStudentCourseController::class, 'pay']);
        Route::get('/student/course/{course}', [ApiStudentCourseController::class, 'detail']);
    });

    // Middleware isInstructor
    Route::middleware('isInstructor')->group(function() {
        // Profile
        Route::put('/instructor/profile', [ApiInstructorController::class, 'profile']);

        // Course
        Route::get('/instructor/course', [ApiInstructorCourseController::class, 'showAll']);
        Route::get('/instructor/course/{course}', [ApiInstructorCourseController::class, 'show']);
        Route::post('/instructor/course/{course}/detail', [ApiInstructorCourseController::class, 'detail']);
        Route::post('/instructor/course/{course}/finish', [ApiInstructorCourseController::class, 'finish']);
    });
});