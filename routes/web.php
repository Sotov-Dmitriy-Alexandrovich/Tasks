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

Route::get('/tasks',function() {
   return view('tasks.tasks');
});
Route::get('/login',function(){
    return view('auth.login');
});
