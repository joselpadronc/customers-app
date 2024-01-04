<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('log.route')->post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::group(
    ["middleware" => ['auth:api', 'log.route']],
    function () {
        Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/customers/{id}', [CustomersController::class, 'getCustomer'])
            ->name('customers.get');
        Route::post('/customers', [CustomersController::class, 'createCustomer'])->middleware('validate.data.customer')
            ->name('customers.create');
        Route::delete('/customers/{id}', [CustomersController::class, 'deleteCustomer'])
            ->name('customers.delete');
    }
);
