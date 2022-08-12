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
    Route::get('/student/enroll/{id}', [StudentController::class, 'enroll'])->name('enroll');
    Route::post('/student/enroll/{package}/{car}', [StudentController::class, 'enrollProcess'])->name('enrollProcess');
    Route::get('/student/enrollment', [StudentController::class, 'enrollment'])->name('enrollment');
    Route::get('/student/enroll/pay/{enroll}', [StudentController::class, 'pay'])->name('pay');
    Route::post('/student/enroll/pay/process/{enroll}', [StudentController::class, 'payProcess'])->name('payProcess');
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/student/profile/edit', [StudentController::class, 'profileEdit'])->name('profileEdit');

    Route::resource('/student/car', StudentCarController::class);
});

Route::middleware('isInstructor')->group(function() {
    Route::get('/instructor', [InstructorController::class ,'index']);
    Route::get('/instructor/enroll/{enroll}', [InstructorController::class, 'enroll']);
    Route::post('/instructor/enroll/{course}/detail', [InstructorController::class, 'detail']);
    Route::put('/instructor/enroll/{enroll}/finish', [InstructorController::class, 'finish']);
    Route::get('/instructor/profile', [InstructorController::class, 'profile']);
    Route::put('/instructor/profile/edit', [InstructorController::class, 'profileEdit']);
});