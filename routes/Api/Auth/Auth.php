<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LogoutController;


Route::post('/login', [LoginController::class,'__invoke'])->middleware('guest');
Route::post('/register', [RegisterController::class,'__invoke'])->middleware('guest');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LogoutController::class,'__invoke']);
});