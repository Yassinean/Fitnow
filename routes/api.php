<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\ProgressionController;


Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [RegisterController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/progression', [ProgressionController::class, 'store'])->name('store');
    Route::patch('progression/update', [ProgressionController::class , 'update'])->name('update');
    Route::delete('progression/delete', [ProgressionController::class , 'destroy'])->name('delete');
});