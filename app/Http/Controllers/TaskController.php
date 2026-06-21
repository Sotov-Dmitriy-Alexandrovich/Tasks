<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Список задач с фильтрацией
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

    // Форма создания
    public function create()
    {
        return view('tasks.create');
    }

    // Сохранение новой задачи
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer|between:1,3',
            'due_date' => 'nullable|date',
        ]);

        auth()->user()->tasks()->create($validated);

        return redirect()->route('tasks.index')->with('success', 'Задача создана!');
    }

    // Форма редактирования
    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    // Обновление задачи
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer|between:1,3',
            'due_date' => 'nullable|date',
            'is_completed' => 'nullable|boolean',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Задача обновлена!');
    }

    // Удаление задачи
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача удалена!');
    }
}
