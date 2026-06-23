<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новая задача — Sotov-Tasks</title>
    <link rel="stylesheet" href="{{ asset('css/task-form.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
</head>
<body>
<main>
    <div class="container">
        <div class="card">
            <a href="{{ route('tasks.index') }}" class="card__back">← Назад к задачам</a>

            <h1 class="card__heading">Новая задача</h1>
            <p class="card__text">Заполните информацию о задаче</p>

            @if($errors->any())
                <div class="errors">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="task-form" method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-group__label" for="title">Название задачи *</label>
                    <input type="text" id="title" name="title"
                           class="form-group__input"
                           value="{{ old('title') }}"
                           placeholder="Например: Сделать домашку по PHP"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-group__label" for="description">Описание</label>
                    <textarea id="description" name="description"
                              class="form-group__textarea"
                              placeholder="Подробное описание задачи...">{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-group__label" for="priority">Приоритет *</label>
                        <select id="priority" name="priority" class="form-group__select" required>
                            <option value="1" {{ old('priority') == 1 ? 'selected' : '' }}>Низкий</option>
                            <option value="2" {{ old('priority', 2) == 2 ? 'selected' : '' }}>Средний</option>
                            <option value="3" {{ old('priority') == 3 ? 'selected' : '' }}>Высокий</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label" for="due_date">Дедлайн</label>
                        <input type="datetime-local" id="due_date" name="due_date"
                               class="form-group__input"
                               value="{{ old('due_date') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn--primary">Создать задачу</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
