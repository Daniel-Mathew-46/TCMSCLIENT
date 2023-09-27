<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Client\Users\UserController;
use App\Http\Controllers\Client\Tariffs\ManageTariffsController;
use App\Http\Controllers\Client\Customers\ManageCustomersController;
use App\Http\Controllers\Client\UtilityProvider\ManageUtilityProviderController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');

Auth::routes();

// ['middleware' => ['auth']],
Route::group([], function () {
    // Route::resource('roles', RoleController::class);
    Route::resource('utility_providers', ManageUtilityProviderController::class);
    Route::resource('provider_category', RegisterController::class);
    Route::resource('tariffs', ManageTariffsController::class);
    Route::resource('customers', ManageCustomersController::class);
    Route::resource('users', UserController::class);
    Route::get('create_customer_payment', [ManageCustomersController::class, 'create_payment'])->name('create_customer_payment');
});

