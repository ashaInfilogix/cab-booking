<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'frontend'])->name('home');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/forgot-password', [UserController::class, 'forgot_password'])->name('forgot-password');
Route::get('/terms', [UserController::class, 'terms'])->name('terms');
