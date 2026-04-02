<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CarController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API working'
    ]);
});

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{id}', [CustomerController::class, 'store']);
Route::post('/customers', [CustomerController::class, 'store']);

//contact api routes
Route::get('/contacts', [ContactController::class, 'display_contacts']);
Route::get('/contacts/{id}', [ContactController::class, 'store']);
Route::post('/contacts', [ContactController::class, 'store']);

//cars api routes
Route::get('/cars', [CarController::class, 'display_cars']);
Route::get('/cars/{id}', [CarController::class, 'store']);
Route::post('/cars', [CarController::class, 'store']);

//customers api routes
Route::get('/customers', [CustomerController::class, 'display_customers']);
Route::get('/customers/{id}', [CustomerController::class, 'store']);
Route::post('/customers', [CustomerController::class, 'store']);




