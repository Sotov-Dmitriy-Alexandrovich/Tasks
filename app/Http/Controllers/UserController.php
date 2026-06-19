<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request){
        $user = User::create($request->all());
        return $user;
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
        $user = User::find($id);
        User::find($id)->update($request->all());
        return response()->json(
            "Пользователь с id $id обновлен"
        );
    }
}
