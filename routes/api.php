<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customers/{id}', [Customers::class, 'getCustomer'])->middleware('log.route')->name('customers.get');
Route::post('customers', [Customers::class, 'createCustomer'])->middleware('log.route')->name('customers.create');
Route::delete('customers/{id}', [Customers::class, 'deleteCustomer'])->middleware('log.route')->name('customers.delete');
