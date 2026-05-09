<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;


Route::get('/', function () {
    return view('website.index');
});

Route::get('/index', function () {
    return view('website.index');
});

Route::get('/about', function () {
    return view('website.about');
});

Route::get('/blog', function () {
    return view('website.blog');
});

Route::get('/bookings', function () {
    return redirect('/booking');
});

Route::get('/customers',[CustomerController:: class,'display_customers']);

Route::get('/cars', [CarController::class, 'cars']);

Route::get('/contact', [ContactController::class, 'create']);
Route::post('/ins_contact', [ContactController::class, 'store']);

Route::post('/contact-submit', [ContactController::class, 'sendmail']);

Route::middleware('user_before')->group(function () {
Route::get('/login',[CustomerController::class,'login']);
Route::post('/check_login',[CustomerController::class,'check_login']);
Route::get('/signup',[CustomerController::class,'create']);
Route::post('/ins_signup',[CustomerController::class,'store']);
});

Route::get('/services', function () {
    return view('website.services');
});

Route::middleware('user_after')->group(function () {
    Route::get('/book-car/{id}', [BookingController::class, 'showBookingForm']);
    Route::post('/book-car', [BookingController::class, 'store']);
    Route::get('/booking', [BookingController::class, 'myBookings']);
    
    Route::get('/user-profile', [CustomerController::class, 'user_profile']);
    Route::get('/edit_profile/{id}', [CustomerController::class, 'edit']);
    Route::post('/update_profile/{id}', [CustomerController::class, 'update']);
    Route::get('/logout',[CustomerController::class,'user_logout']);

    // Payment Routes
    Route::get('/payment/{booking_id}', [\App\Http\Controllers\PaymentController::class, 'paymentPage']);
    Route::post('/payment/create-order/{booking_id}', [\App\Http\Controllers\PaymentController::class, 'createOrder']);
    Route::post('/payment/success', [\App\Http\Controllers\PaymentController::class, 'paymentSuccess']);
    Route::post('/payment/failure', [\App\Http\Controllers\PaymentController::class, 'paymentFailure']);
});

Route::get('/single', function () {
    return view('website.single');
});

Route::get('/status_customer/{id}', [CustomerController::class, 'status_customer']);


//=============== admin ==================//

Route::middleware('admin_before')->group(function(){

Route::get('/admin-login', [AdminController::class, 'admin_login']);
Route::post('/admin_auth', [AdminController::class, 'admin_auth']);

});


Route::middleware('admin_after')->group(function(){
Route::get('/admin-logout', [AdminController::class, 'admin_logout']);
Route::get('/dashboard', [AdminController::class, 'dashboard']);



//Categories

Route::get('/add_category', [CategoryController::class, 'create']);
Route::post('/add_category', [CategoryController::class, 'store']);
Route::get('/manage_category', [CategoryController::class, 'index']);
Route::get('/delete_category/{id}', [CategoryController::class, 'destroy']);
Route::get('/edit_category/{id}', [CategoryController::class, 'edit']);
Route::post('/update_category/{id}', [CategoryController::class, 'update']);

// Cars categories
Route::get('/add_car', [CarController::class, 'create']);
Route::post('/add_car', [CarController::class, 'store']);
Route::get('/manage_car',[CarController::class,'index']);
Route::get('/delete_car/{id}',[CarController::class,'destroy']);
Route::get('/edit_car/{id}',[CarController::class,'edit']);
Route::post('/update_car/{id}',[CarController::class,'update']);

// Admin Bookings
Route::get('/manage_bookings',[BookingController::class,'adminIndex']);
Route::post('/manage_bookings/status/{id}',[BookingController::class,'updateStatus']);

Route::get('/add_customer', function () {
    return view('admin.add_customer');
});

Route::get('/manage_customers', [CustomerController::class, 'manage_customers']);

Route::get('/delete_customer/{id}', [CustomerController::class, 'destroy']);

Route::get('/manage_contact', [ContactController::class, 'manage_contact']);
Route::get('/delete_contact/{id}', [ContactController::class, 'destroy']);

});

















