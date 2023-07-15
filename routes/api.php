<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/user', function () {
//     return "lkdjfksd";
// });




// Route::apiResource('auth', App\Http\Controllers\AuthController::class);

// Route::apiResource('form', App\Http\Controllers\FormController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// make sure to add this middleware to protect routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('update_profile', [AuthController::class, 'update_profile']);
    Route::post('verifyOTP', [AuthController::class, 'verifyOTP']);
    Route::post('resendOTP', [AuthController::class, 'resendOTP']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('forms', [FormController::class, 'index']);
    Route::post('/form/create', [FormController::class, 'store']);
    Route::post('/form/update/{id}', [FormController::class, 'update']);
    Route::get('/form/{id}', [FormController::class, 'show']);
    Route::post('/submition', [FormController::class, 'submition']);
    Route::resource('forms', FormController::class);
});
