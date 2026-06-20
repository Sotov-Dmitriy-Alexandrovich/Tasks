<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(RegisterRequest $request){
        $user = User::create($request->validated());

        Auth::login($user);
        return redirect()->route('tasks.index')->with('success', 'Регистрация успешна! Добро пожаловать!');
    }
    public function index(){
        return User::all();
    }
    public function destroy($id){
        User::find($id)->delete();
        return response()->json(
            "User с id $id Удален"
        );
    }
    public function update(Request $request, $id){
        User::find($id)->update($request->all());
        return response()->json(
            "Пользователь с id $id обновлен"
        );
    }
}
