<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request){
        $task = Task::create($request->all());
        return $task;
    }
    public function index(Request $request)
    {

        $tasks = $request->user()->tasks()->orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks'));
    }
    public function destroy($id){
        Task::find($id)->delete();
        return response()->json(
            "User с id $id Удален"
        );
    }
    public function update(Request $request, $id){
        Task::find($id)->update($request->all());
        return response()->json(
            "Пользователь с id $id обновлен"
        );
    }
}
