<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;

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
Route::get('/transmission', [ApiTransmissionController::Class, 'show']);

// Route that must be authorized
Route::middleware('auth:sanctum')->group(function() {
    // Authorization
    Route::get('/profile', [ApiAuthController::class, 'profile']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);
});


Route::get('/test', function() {
    return response([
        'message' => 'Hello World!'
    ]);
});