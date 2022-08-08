<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiBrandController;
use App\Http\Controllers\Api\ApiPackageController;
use App\Http\Controllers\Api\ApiTransmissionController;

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

// Route that must be authorized
Route::middleware('auth:sanctum')->group(function() {
    // Authorization
    Route::get('/profile', [ApiAuthController::class, 'profile']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);

    // Brand
    Route::post('/brand/create', [ApiBrandController::class, 'create']);
    Route::put('/brand/{brand}/edit', [ApiBrandController::class, 'edit']);
    Route::delete('/brand/{brand}/delete', [ApiBrandController::class, 'delete']);

    // Package
    Route::post('/package/create', [ApiPackageController::class, 'create']);
    Route::put('/package/{package}/edit', [ApiPackageController::class, 'edit']);
    Route::delete('/package/{package}/delete', [ApiPackageController::class, 'delete']);
});