<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация — TaskManager</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 450px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 16px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        h1 {
            color: #1a202c;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718096;
            font-size: 15px;
        }

        .errors {
            background: #fff5f5;
            border-left: 4px solid #e53e3e;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .errors ul {
            list-style: none;
            color: #c53030;
            font-size: 14px;
        }

        .errors li {
            padding: 4px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .errors li::before {
            content: "⚠️";
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            display: block;
            color: #4a5568;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper::before {
            content: "";
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.5;
        }

        .input-wrapper.user::before {
            content: "👤";
            font-size: 16px;
            width: auto;
        }

        .input-wrapper.email::before {
            content: "✉️";
            font-size: 16px;
            width: auto;
        }

        .input-wrapper.lock::before {
            content: "🔒";
            font-size: 16px;
            width: auto;
        }

        input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            background: #f7fafc;
            transition: all 0.3s ease;
            color: #1a202c;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        input::placeholder {
            color: #a0aec0;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }

        .btn:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 24px 0;
            position: relative;
        }

        .divider::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            color: #718096;
            font-size: 14px;
            position: relative;
        }

        .login-link {
            text-align: center;
            color: #4a5568;
            font-size: 15px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .features {
            margin-top: 24px;
            padding: 16px;
            background: #f7fafc;
            border-radius: 12px;
            display: flex;
            justify-content: space-around;
        }

        .feature {
            text-align: center;
            color: #718096;
            font-size: 12px;
        }

        .feature-icon {
            font-size: 24px;
            margin-bottom: 4px;
            display: block;
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 24px;
            }

            .row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="header">
            <div class="logo">✅</div>
            <h1>Создать аккаунт</h1>
            <p class="subtitle">Начните управлять задачами прямо сейчас</p>
        </div>

        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <div class="form-group">
                    <label>Имя</label>
                    <div class="input-wrapper user">
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Иван" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Фамилия</label>
                    <div class="input-wrapper user">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Иванов" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <div class="input-wrapper email">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="ivan@example.com" required>
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

            <button type="submit" class="btn">Зарегистрироваться 🚀</button>
        </form>

        <div class="features">
            <div class="feature">
                <span class="feature-icon">📋</span>
                Задачи
            </div>
            <div class="feature">
                <span class="feature-icon">🎯</span>
                Приоритеты
            </div>
            <div class="feature">
                <span class="feature-icon">📅</span>
                Дедлайны
            </div>
        </div>

        <div class="divider">
            <span>или</span>
        </div>

        <p class="login-link">
            Уже есть аккаунт? <a href="/login">Войти</a>
        </p>
    </div>
</div>
</body>
</html>
