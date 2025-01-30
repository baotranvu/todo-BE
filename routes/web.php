<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Models\User;
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class,'__invoke'])->middleware('guest');
    Route::post('/register', [RegisterController::class,'__invoke'])->middleware('guest');
    Route::post('/logout', [LogoutController::class,'__invoke'])->middleware('auth:sanctum');
});

Auth::routes(['verify' => true]);

Route::get('email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);

    if (!hash_equals($hash, sha1($user->getEmailForVerification()))) {
        throw new \Illuminate\Validation\ValidationException('Invalid verification link');
    }

    $user->markEmailAsVerified();

    // Sau khi xác thực email thành công, chuyển hướng về frontend (FE)
    return redirect()->away(env('FRONTEND_URL'));  // Chỉnh sửa đường dẫn FE của bạn
})->name('verification.verify');
