<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Requests\TaskStoreRequest;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->tasks();

        if ($request->has('filter')) {
            if ($request->filter === 'active') {
                $query->where('is_completed', false);
            } elseif ($request->filter === 'completed') {
                $query->where('is_completed', true);
            }
        }

        if ($request->has('priority')) {
            $query->where('priority', (int)$request->priority);
        }

        $tasks = $query->orderBy('is_completed', 'asc')
            ->orderBy('due_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskStoreRequest $request)
    {
        auth()->user()->tasks()->create($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Задача создана!');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Задача обновлена!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача удалена!');
    }
}
