<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('website.index');
});

Route::get('/index', function () {
    return view('website.index');
});

Route::get('/about', function () {
    return view('website.about');
});

Route::get('/blog-single', function () {
    return view('website.blog-single');
});

Route::get('/contact', function () {
    return view('website.contact');
});

Route::get('/blog', function () {
    return view('website.blog');
});

Route::get('/car-single', function () {
    return view('website.car-single');
});

Route::get('/car', function () {
    return view('website.car');
});

Route::get('/pricing', function () {
    return view('website.pricing');
});

Route::get('/services', function () {
    return view('website.services');
});

Route::get('/login', function () {
    return view('website.login');
});

Route::get('/register', function () {
    return view('website.register');
});

Route::get('/shop', function () {
    return view('website.shop');
});

Route::get('/shop-single', function () {
    return view('website.shop-single');
});

Route::get('/terms', function () {
    return view('website.terms');
});

Route::get('/testimonials', function () {
    return view('website.testimonials');
});

Route::get('/tracking', function () {
    return view('website.tracking');
});

Route::get('/vehicle', function () {
    return view('website.vehicle');
});

Route::get('/vehicle-single', function () {
    return view('website.vehicle-single');
});

Route::get('/wishlist', function () {
    return view('website.wishlist');
});

