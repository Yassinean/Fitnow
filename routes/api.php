<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProgressionController;




Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [RegisterController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [RegisterController::class, 'logout'])->name('logout');
    Route::resource('progression', ProgressionController::class);
});