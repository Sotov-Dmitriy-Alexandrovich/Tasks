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
                    </div>
                </div>

                <div class="form-group">
                    <label>Подтвердите пароль</label>
                    <div class="input-wrapper lock">
                        <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
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

</body>
</html>
