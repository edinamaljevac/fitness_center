<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Payments
    Route::get('/payments', [PaymentController::class, 'index']);

    Route::get(
        '/payments/memberships/active',
        [PaymentController::class, 'activeMemberships']
    );

    Route::post('/payments', [PaymentController::class, 'store']);

    Route::get('/payments/{payment}', [PaymentController::class, 'show']);
});