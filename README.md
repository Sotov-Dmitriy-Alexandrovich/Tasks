# Sotov-Tasks

[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Nginx](https://img.shields.io/badge/Nginx-009639?logo=nginx&logoColor=white)](https://nginx.org/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

> Веб-приложение для управления задачами с авторизацией, фильтрацией и приоритетами.

 **Сам сайт:** [https://tasks.sotov.tech](https://tasks.sotov.tech)

---

## Описание

Sotov-Tasks — это минималистичный менеджер задач, где пользователь может:

-  Регистрироваться и входить в аккаунт
-  Создавать, редактировать и удалять задачи
-  Отмечать задачи как выполненные одним кликом
-  Фильтровать задачи по статусу (активные / выполненные)
-  Фильтровать задачи по приоритету (низкий / средний / высокий)
-  Устанавливать дедлайны

---

##  Технологический стек

**Backend:** Laravel 11 (PHP 8.4), Eloquent ORM, MySQL 8.0, сессионная аутентификация  
**Frontend:** Blade-шаблоны, Vanilla JS, CSS (BEM), SVG-иконки  
**DevOps:** Nginx + PHP-FPM 8.4, Ubuntu 24.04 LTS, Git, Certbot + Let's Encrypt (SSL)

---

##  Установка

### Требования
- PHP 8.4+
- Composer
- MySQL 8.0+
- Nginx или Apache

### Шаги

```bash
# 1. Клонируйте репозиторий
git clone https://github.com/Sotov-Dmitriy-Alexandrovich/Tasks.git
cd Tasks

# 2. Установите зависимости
composer install

# 3. Скопируйте .env
cp .env.example .env

# 4. Сгенерируйте ключ
php artisan key:generate

# 5. Настройте БД в .env
# DB_DATABASE=tasks
# DB_USERNAME=your_user
# DB_PASSWORD=your_password

# 6. Запустите миграции
php artisan migrate

# 7. Запустите сервер
php artisan serve
