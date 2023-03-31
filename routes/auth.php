<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthController::class, 'create'])->name('auth.create');
    Route::post('/login', [AuthController::class, 'store'])->name('auth.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.delete');
    Route::get('/completed/register', function () {
        return view('completed.register', ['title' => '仮登録完了']);
    })->name('completed.register');
    Route::get('/completed/update', function () {
        return view('completed.update', ['title' => 'メールアドレス変更完了']);
    })->name('completed.update');
    Route::get('/verification/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('/verification/retry', [VerificationController::class, 'retry'])->name('verification.retry');
    Route::get('/verification/expired', [VerificationController::class, 'expired'])->name('verification.expired');
});
