<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои задачи — Sotov-Tasks</title>
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
</head>
<body>
<main>
    <div class="container">

        <!-- Шапка -->
        <header class="header">
            <div class="header__info">
                <h1 class="header__title">Мои задачи</h1>
                <p class="header__subtitle">
                    Привет, <span class="header__user">{{ auth()->user()->first_name ?? 'Гость' }}</span>
                </p>
            </div>
            <div class="header__actions">
                <a href="#" class="btn btn--primary">+ Создать задачу</a>
                <form action="#" method="POST" class="header__logout">
                    @csrf
                    <button type="submit" class="btn btn--secondary">Выйти</button>
                </form>
            </div>
        </header>

        <!-- Сообщение об успехе -->
        @if(session('success'))
            <div class="alert alert--success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Фильтры -->
        <div class="filters">
            <div class="filters__group">
                <span class="filters__label">Статус:</span>
                <div class="filters__tabs">
                    <a href="{{ route('tasks.index') }}"
                       class="filters__tab {{ request('filter') === null ? 'filters__tab--active' : '' }}">
                        Все
                    </a>
                    <a href="{{ route('tasks.index', ['filter' => 'active']) }}"
                       class="filters__tab {{ request('filter') === 'active' ? 'filters__tab--active' : '' }}">
                        Активные
                    </a>
                    <a href="{{ route('tasks.index', ['filter' => 'completed']) }}"
                       class="filters__tab {{ request('filter') === 'completed' ? 'filters__tab--active' : '' }}">
                        Выполненные
                    </a>
                </div>
            </div>

            <div class="filters__group">
                <span class="filters__label">Приоритет:</span>
                <div class="filters__tabs">
                    <a href="{{ route('tasks.index', array_merge(request()->except('priority'), [])) }}"
                       class="filters__tab {{ request('priority') === null ? 'filters__tab--active' : '' }}">
                        Все
                    </a>
                    <a href="{{ route('tasks.index', array_merge(request()->except('priority'), ['priority' => 1])) }}"
                       class="filters__tab filters__tab--priority-1 {{ request('priority') == 1 ? 'filters__tab--active' : '' }}">
                        Низкий
                    </a>
                    <a href="{{ route('tasks.index', array_merge(request()->except('priority'), ['priority' => 2])) }}"
                       class="filters__tab filters__tab--priority-2 {{ request('priority') == 2 ? 'filters__tab--active' : '' }}">
                        Средний
                    </a>
                    <a href="{{ route('tasks.index', array_merge(request()->except('priority'), ['priority' => 3])) }}"
                       class="filters__tab filters__tab--priority-3 {{ request('priority') == 3 ? 'filters__tab--active' : '' }}">
                        Высокий
                    </a>
                </div>
            </div>
        </div>

        <!-- Список задач -->
        <div class="tasks">
            @forelse($tasks ?? [] as $task)
                <article class="task {{ $task->is_completed ? 'task--completed' : '' }}">
                    <div class="task__content">
                        <div class="task__header">
                            <h3 class="task__title">{{ $task->title }}</h3>
                            <span class="task__priority task__priority--{{ $task->priority }}">
                                {{ ['Низкий', 'Средний', 'Высокий'][$task->priority - 1] ?? 'Средний' }}
                            </span>
                        </div>

                        @if($task->description)
                            <p class="task__description">{{ $task->description }}</p>
                        @endif

                        <div class="task__meta">
                            @if($task->due_date)
                                <span class="task__due">
                                    📅 {{ \Carbon\Carbon::parse($task->due_date)->format('d.m.Y H:i') }}
                                </span>
                            @endif
                            <span class="task__created">
                                Создано: {{ \Carbon\Carbon::parse($task->created_at)->format('d.m.Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="task__actions">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="task__toggle">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_completed" value="{{ $task->is_completed ? 0 : 1 }}">
                            <button type="submit" class="btn-icon" title="{{ $task->is_completed ? 'Вернуть в активные' : 'Отметить выполненной' }}">
                                {{ $task->is_completed ? '↩️' : '✓' }}
                            </button>
                        </form>

                        <a href="#" class="btn-icon" title="Редактировать">
                            ✏️
                        </a>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="task__delete"
                              onsubmit="return confirm('Удалить задачу?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-icon--danger" title="Удалить">
                                🗑️
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <div class="empty-state__icon">📋</div>
                    <h2 class="empty-state__title">Задач пока нет</h2>
                    <p class="empty-state__text">Создайте свою первую задачу, чтобы начать планировать день</p>
                    <a href="#" class="btn btn--primary">+ Создать задачу</a>
                </div>
            @endforelse
        </div>

    </div>
</main>
</body>
</html>
