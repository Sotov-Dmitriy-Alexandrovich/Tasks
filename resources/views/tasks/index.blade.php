<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои задачи — Sotov-Tasks</title>
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
</head>
<body>
<main>
    <div class="container">

        <header class="header">
            <div class="header__info">
                <h1 class="header__title">Мои задачи</h1>
                <p class="header__subtitle">
                    Привет, <span class="header__user">{{ auth()->user()->first_name ?? 'Гость' }}</span>
                </p>
            </div>
            <div class="header__actions">
                <a href="{{ route('tasks.create') }}" class="btn btn--primary">+ Создать задачу</a>
                <form action="{{ route('logout') }}" method="POST" class="header__logout">
                    @csrf
                    <button type="submit" class="btn btn--secondary">Выйти</button>
                </form>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert--success">
                {{ session('success') }}
            </div>
        @endif

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
                    <a href="{{ route('tasks.index', request()->except('priority')) }}"
                       class="filters__tab {{ request('priority') === null ? 'filters__tab--active' : '' }}">
                        Все
                    </a>
                    <a href="{{ route('tasks.index', array_merge(request()->except('priority'), ['priority' => 1])) }}"
                       class="filters__tab {{ request('priority') == 1 ? 'filters__tab--active' : '' }}">
                        Низкий
                    </a>
                    <a href="{{ route('tasks.index', array_merge(request()->except('priority'), ['priority' => 2])) }}"
                       class="filters__tab {{ request('priority') == 2 ? 'filters__tab--active' : '' }}">
                        Средний
                    </a>
                    <a href="{{ route('tasks.index', array_merge(request()->except('priority'), ['priority' => 3])) }}"
                       class="filters__tab {{ request('priority') == 3 ? 'filters__tab--active' : '' }}">
                        Высокий
                    </a>
                </div>
            </div>
        </div>

        <div class="tasks">
            @forelse($tasks as $task)
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
                                     {{ \Carbon\Carbon::parse($task->due_date)->format('d.m.Y H:i') }}
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
                            <input type="hidden" name="title" value="{{ $task->title }}">
                            <input type="hidden" name="description" value="{{ $task->description }}">
                            <input type="hidden" name="priority" value="{{ $task->priority }}">
                            <input type="hidden" name="due_date" value="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : '' }}">
                            <input type="hidden" name="is_completed" value="{{ $task->is_completed ? 0 : 1 }}">
                            <button type="submit" class="btn-icon" title="{{ $task->is_completed ? 'Вернуть в активные' : 'Отметить выполненной' }}">
                                @if($task->is_completed)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 7v6h6"/>
                                        <path d="M21 17a9 9 0 0 0-9-9 9 9 0 0 0-6 2.3L3 13"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                @endif
                            </button>
                        </form>

                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn-icon" title="Редактировать">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </a>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="task__delete"
                              onsubmit="return confirm('Удалить задачу?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-icon--danger" title="Удалить">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6l-2 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L5 6"/>
                                    <path d="M10 11v6"/>
                                    <path d="M14 11v6"/>
                                    <path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <div class="empty-state__icon"></div>
                    <h2 class="empty-state__title">Задач пока нет</h2>
                    <p class="empty-state__text">Создайте свою первую задачу, чтобы начать планировать день</p>
                    <a href="{{ route('tasks.create') }}" class="btn btn--primary">+ Создать задачу</a>
                </div>
            @endforelse
        </div>

    </div>
</main>
</body>
</html>
