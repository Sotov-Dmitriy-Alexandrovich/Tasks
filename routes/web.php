<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/register',function() {
    return view('auth.register');
})->name('register.form');
Route::post('/register', [UserController::class, 'store'])->name('register');
