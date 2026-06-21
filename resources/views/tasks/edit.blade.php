<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать задачу — Sotov-Tasks</title>
    <link rel="stylesheet" href="{{ asset('css/task-form.css') }}">
</head>
<body>
<main>
    <div class="container">
        <div class="card">
            <a href="{{ route('tasks.index') }}" class="card__back">← Назад к задачам</a>

            <h1 class="card__heading">Редактировать задачу</h1>
            <p class="card__text">Измените информацию о задаче</p>

            @if($errors->any())
                <div class="errors">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="task-form" method="POST" action="{{ route('tasks.update', $task->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-group__label" for="title">Название задачи *</label>
                    <input type="text" id="title" name="title"
                           class="form-group__input"
                           value="{{ old('title', $task->title) }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-group__label" for="description">Описание</label>
                    <textarea id="description" name="description"
                              class="form-group__textarea">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-group__label" for="priority">Приоритет *</label>
                        <select id="priority" name="priority" class="form-group__select" required>
                            <option value="1" {{ old('priority', $task->priority) == 1 ? 'selected' : '' }}>Низкий</option>
                            <option value="2" {{ old('priority', $task->priority) == 2 ? 'selected' : '' }}>Средний</option>
                            <option value="3" {{ old('priority', $task->priority) == 3 ? 'selected' : '' }}>Высокий</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label" for="due_date">Дедлайн</label>
                        <input type="datetime-local" id="due_date" name="due_date"
                               class="form-group__input"
                               value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>

                <div class="form-group form-group--checkbox">
                    <label class="form-group__checkbox-label">
                        <input type="hidden" name="is_completed" value="0">
                        <input type="checkbox" name="is_completed" value="1"
                            {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
                        <span>Задача выполнена</span>
                    </label>
                </div>

                <button type="submit" class="btn btn--primary">Сохранить изменения</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
