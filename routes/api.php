<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customers;

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

Route::middleware('log.route')->controller(Customers::class)->group(function () {
    Route::get('/customers/{id}', 'getCustomer')->name('customers.get');
    Route::post('/customers', 'createCustomer')->middleware('validate.data.customer')->name('customers.create');
    Route::delete('/customers/{id}', 'deleteCustomer')->name('customers.delete');
});
