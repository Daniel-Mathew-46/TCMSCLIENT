<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Client\Roles\RoleController;
use App\Http\Controllers\Client\Users\UserController;
use App\Http\Controllers\Client\Tariffs\ManageTariffsController;
use App\Http\Controllers\Client\Customers\ManageCustomersController;
use App\Http\Controllers\Client\Debts\DebtController;
use App\Http\Controllers\Client\UtilityProvider\ManageUtilityProviderController;
use App\Http\Controllers\Client\ProviderCategory\ManageProviderCategoryController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

// ['middleware' => ['auth']],
Route::group(['middleware' => ['auth']], function () {
    Route::resource('utility_providers', ManageUtilityProviderController::class);
    Route::resource('provider_categories', ManageProviderCategoryController::class);
    Route::resource('tariffs', ManageTariffsController::class);
    Route::resource('customers', ManageCustomersController::class);
    Route::get('customer/payment/{customerId}', [ManageCustomersController::class, 'create_payment'])->name('customer.payment');
    Route::resource('debts', DebtController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});

