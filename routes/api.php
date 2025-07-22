<?php
// routes/api.php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Payament info
Route::post('/payment/notify', [PaymentController::class, 'getPaymentInfo']);
