<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarModelController;  
use App\Http\Controllers\CarBrandController;  
use App\Http\Controllers\DriverController;  
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'frontend'])->name('home');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/forgot-password', [UserController::class, 'forgot_password'])->name('forgot-password');
Route::get('/terms', [UserController::class, 'terms'])->name('terms');

//Route::middleware(['auth', 'auth.session'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::view('/','admin.index')->name('home');
        //Route::view('/models','admin.car-model.index')->name('model-list');
        Route::resources([
            'cars' => CarController::class,
            'car-model' => CarModelController::class,
            'car-brand' => CarBrandController::class,
            'drivers'   => DriverController::class
        ]);
        

    });
Route::post('get-car-brands', [CarController::class, 'getCarModels']);  
Route::post('delete-car-image', [CarController::class, 'deleteCarImage']);  

//});

