<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarModelController;  
use App\Http\Controllers\CarBrandController;  
use App\Http\Controllers\DriverController;  
use App\Http\Controllers\BookingController;  
use App\Http\Controllers\SettingController;  
 
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'frontend'])->name('home');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login-post', [UserController::class, 'loginPost'])->name('login-post');


Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/post-register', [UserController::class, 'registerPost'])->name('register-post');

Route::get('/forgot-password', [UserController::class, 'forgot_password'])->name('forgot-password');
Route::get('/terms', [UserController::class, 'terms'])->name('terms');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'auth.session'])->group(function () {
    
    Route::prefix('admin')->group(function () {

        Route::get('/', [HomeController::class, 'backend'])->name('admin-home');
        Route::resources([
            'bookings' => BookingController::class,
            'cars' => CarController::class,
            'car-model' => CarModelController::class,
            'car-brand' => CarBrandController::class,
            'drivers'   => DriverController::class
        ]);
        Route::get('profile', [UserController::class, 'adminProfile'])->name('profile');
        Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update-profile');

        Route::get('settings', [SettingController::class, 'index'])->name('setting');
        Route::post('update-settings', [SettingController::class, 'update'])->name('update-setting');

        Route::get('new-drivers-request', [DriverController::class, 'newDriversRequest'])->name('new.driver');
        Route::get('drivers-request-view/{id}', [DriverController::class, 'viewDriverRequest'])->name('view-request');
        Route::post('update-driver-status/{id}', [DriverController::class, 'updateDriverStatus'])->name('driver.status');   
    });

    Route::post('get-car-brands', [CarController::class, 'getCarModels']);  
    Route::post('delete-car-image', [CarController::class, 'deleteCarImage']);   
 
    
});
Route::prefix('admin')->group(function () {
    Route::resources([            
        'drivers'   => DriverController::class
    ]);
});


// New Routes
//Route::view('payment-plan','driver-register.payment-plan');
Route::get('payment/{id?}',[DriverController::class, 'paymentPlans'])->name('payment.plan');

Route::post('get-car-brands', [CarController::class, 'getCarModels']); 
Route::post('add-car-details', [DriverController::class, 'carDetailsUpdate'])->name('car.detail'); 
Route::get('driver-register/{id?}', [DriverController::class, 'registerDriver'])->name('driver.register');

