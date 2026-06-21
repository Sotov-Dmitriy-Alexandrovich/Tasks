<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('tasks.index');
    }
    return redirect()->route('login.form');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

Route::post('/register', [UserController::class, 'store'])->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login.form');
    })->name('logout');
});
