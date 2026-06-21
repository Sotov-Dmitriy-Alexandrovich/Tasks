<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        Auth::login($user);
        return redirect()->route('tasks.index')->with('success', 'Регистрация успешна! Добро пожаловать!');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended(route('tasks.index'))->with('success', 'Добро пожаловать!');
        }

        return back()
            ->withErrors([
                'email' => 'Неверный email или пароль',
            ])
            ->onlyInput('email');
    }
}
