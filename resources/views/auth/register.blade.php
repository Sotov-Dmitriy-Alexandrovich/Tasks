<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация — Sotov-Tasks</title>
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
</head>
<body>
<main>
    <div class="container">
        <div class="card">
            <h1 class="card__heading">Создать аккаунт</h1>
            <p class="card__text">Начните управлять задачами прямо сейчас</p>
            @if($errors->any())
                <div class="errors">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form-register" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">
                    <div class="form-group">
                        <label>Имя</label>
                        <div class="input-wrapper user">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Иван"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Фамилия</label>
                        <div class="input-wrapper user">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Иванов"
                                   required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrapper email">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="ivan@example.com"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Пароль</label>
                    <div class="input-wrapper lock">
                        <input type="password" name="password" placeholder="Минимум 6 символов" required>
                        <button type="button" class="toggle-password" aria-label="Показать пароль">
                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Подтвердите пароль</label>
                    <div class="input-wrapper lock">
                        <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                        <button type="button" class="toggle-password" aria-label="Показать пароль">
                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn">Зарегистрироваться</button>
            </form>
            <p class="login-link">
                Уже есть аккаунт? <a href="/login">Войти</a>
            </p>
        </div>
    </div>
</main>

<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            this.classList.toggle('active');
        });
    });
</script>

</body>
</html>
