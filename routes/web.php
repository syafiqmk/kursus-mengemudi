<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\AdminPackageController;
use App\Http\Controllers\AdminInstructorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/403', function () {
    return view('403');
})->name('403');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('isAdmin')->group(function() {
    Route::get('/admin', function() {
        return view('admin.index', [
            'title' => 'Dashboard Admin'
        ]);
    });

    Route::resource('/admin/brand', AdminBrandController::class)->except('show');
    Route::resource('/admin/car', AdminCarController::class);
    Route::resource('/admin/instructor', AdminInstructorController::class);
    Route::resource('/admin/package', AdminPackageController::class);

    Route::get('/admin/enroll', [AdminController::class, 'enrollment']);
    Route::get('/admin/enroll/{enroll}', [AdminController::class, 'enrollDetail']);
    Route::put('/admin/enroll/{enroll}/{instructor}', [AdminController::class, 'enrollProcess']);
});

Route::middleware('isStudent')->group(function() {
    Route::get('/student', [StudentController::class, 'index'])->name('studentIndex');
    Route::get('/student/enroll/{id}', [StudentController::class, 'enroll'])->name('studentEnroll');
    Route::post('/student/enroll/{package}/{car}', [StudentController::class, 'enrollProcess']);
    Route::get('/student/enrollment', [StudentController::class, 'enrollment']);
    Route::get('/student/enroll/pay/{enroll}', [StudentController::class, 'pay']);
    Route::post('/student/enroll/pay/process/{enroll}', [StudentController::class, 'payProcess']);
    Route::get('/student/profile', [StudentController::class, 'profile']);
    Route::put('/student/profile/edit', [StudentController::class, 'profileEdit']);
});

Route::middleware('isInstructor')->group(function() {
    Route::get('/instructor', [InstructorController::class ,'index']);
    Route::get('/instructor/enroll/{enroll}', [InstructorController::class, 'enroll']);
    Route::put('/instructor/enroll/{enroll}/finish', [InstructorController::class, 'finish']);
    Route::get('/instructor/profile', [InstructorController::class, 'profile']);
    Route::put('/instructor/profile/edit', [InstructorController::class, 'profileEdit']);
});