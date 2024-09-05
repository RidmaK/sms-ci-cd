<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;


Route::post('/api-register',[AuthController::class, 'register'])->name('api-register');
Route::post('/api-login',[AuthController::class, 'login'])->name('api-login');
Route::apiResource('/api-student', StudentController::class);
Route::middleware('auth:api')->group(function(){
    // Route::apiResource('/api-student', StudentController::class);
});
