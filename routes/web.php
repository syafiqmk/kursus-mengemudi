<?php

use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentCarController;
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
    return view('welcome', [
        'packages' => Package::latest()->get()
    ]);
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

Route::middleware('isStudent')->name('student.')->group(function() {
    Route::get('/student', [StudentController::class, 'index'])->name('index');
    Route::get('/student/course/{package}', [StudentController::class, 'package'])->name('package');
    Route::post('/student/course/{package}/{car}', [StudentController::class, 'enrollProcess'])->name('enrollProcess');

    Route::get('/student/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/student/course/pay/{course}', [StudentController::class, 'pay'])->name('pay');
    Route::post('/student/course/pay/process/{course}', [StudentController::class, 'payProcess'])->name('payProcess');
    Route::get('/student/course/detail/{course}', [StudentController::class, 'courseDetail'])->name('courseDetail');

    Route::get('/student/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/student/profile/edit', [StudentController::class, 'profileEdit'])->name('profileEdit');

    Route::resource('/student/car', StudentCarController::class);
});

Route::middleware('isInstructor')->name('instructor.')->group(function() {
    Route::get('/instructor', [InstructorController::class ,'index'])->name('index');
    Route::get('/instructor/course/{course}', [InstructorController::class, 'course'])->name('course');
    Route::post('/instructor/course/{course}/detail', [InstructorController::class, 'detail'])->name('addDetail');
    Route::put('/instructor/course/{course}/finish', [InstructorController::class, 'finish'])->name('finish');
    Route::get('/instructor/profile', [InstructorController::class, 'profile'])->name('profile');
    Route::put('/instructor/profile/edit', [InstructorController::class, 'profileEdit'])->name('profileEdit');

    Route::get('/instructor/history', [InstructorController::class, 'history'])->name('history');
    Route::get('/instructor/history/{course}', [InstructorController::class, 'historyDetail'])->name('historyDetail');
});