<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Регистрация
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        Auth::login($user);
        return redirect()->route('tasks.index')->with('success', 'Регистрация успешна! Добро пожаловать!');
    }

    // Вход
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Введите email',
            'email.email' => 'Введите корректный email',
            'password.required' => 'Введите пароль',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('tasks.index'))->with('success', 'Добро пожаловать!');
        }

        return back()
            ->withErrors([
                'email' => 'Неверный email или пароль',
            ])
            ->onlyInput('email');
    }

    // Список пользователей (если нужен)
    public function index()
    {
        return User::all();
    }

    // Удаление пользователя
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        $user->delete();
        return response()->json(['message' => "User с id $id удален"]);
    }

    // Обновление пользователя
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $id,
        ]);

        $user->update($validated);
        return response()->json(['message' => "Пользователь с id $id обновлен", 'user' => $user]);
    }
}
