# 🍽️ Grand Restoran - Premium Restaurant Management System

> Профессиональная веб-платформа управления премиальным рестораном на Laravel 12

![Status](https://img.shields.io/badge/status-active-success) ![Laravel](https://img.shields.io/badge/laravel-12-red) ![PHP](https://img.shields.io/badge/php-8.2+-blue) ![License](https://img.shields.io/badge/license-MIT-green)

## 🌟 Основные Возможности

### 👥 Для Клиентов
- ✅ Регистрация и авторизация
- ✅ Просмотр полного меню (150+ блюд)
- ✅ Бронирование столов
- ✅ Размещение заказов
- ✅ Личный кабинет (история заказов и бронирований)
- ✅ Управление профилем

### 👨‍💼 Для Администраторов
- ✅ Полное управление меню (категории и блюда)
- ✅ Управление столами и их статусами
- ✅ Управление резервирования (подтверждение, отмена)
- ✅ Управление заказами (создание, отслеживание статуса)
- ✅ Аналитика и статистика в реальном времени
- ✅ Панель управления с KPI

## 💻 Технологический Стек

```
Backend:        Laravel 12, PHP 8.2+, SQLite
Frontend:       Blade, Tailwind CSS 3, Alpine.js, Vite
Design:         Playfair Display (serif), Inter (sans-serif)
```

## 📁 Структура Проекта

```
restaran/
├── app/Http/Controllers/
│   ├── Admin/              # Админ контроллеры
│   │   ├── DashboardController.php
│   │   ├── CategoryController.php
│   │   ├── FoodController.php
│   │   ├── TableController.php
│   │   ├── OrderController.php
│   │   └── ReservationController.php
│   └── Auth/              # Авторизация
│       └── RegisteredUserController.php
├── app/Models/            # Eloquent модели
├── database/migrations/   # Создание таблиц
├── resources/views/       # Blade шаблоны
│   ├── home.blade.php, menu.blade.php, reservation.blade.php
│   ├── admin/             # Admin страницы
│   └── auth/              # Auth страницы
└── routes/web.php         # Маршруты приложения
```

**Полная структура описана в PROJECT_DOCUMENTATION.md**

## 🚀 Быстрый Старт

### Требования
- PHP 8.2+ с расширениями: curl, json, mbstring, pdo_sqlite
- Composer
- Node.js 16+ и npm
- Git

### Установка

```bash
# Клонировать репозиторий
git clone <url> && cd restaran

# Установить зависимости
composer install && npm install

# Конфиг
cp .env.example .env && php artisan key:generate

# БД
php artisan migrate && php artisan db:seed

# Собрать фронтенд
npm run build

# Для разработки:
npm run dev
```

### Запуск

```bash
php artisan serve
# http://localhost:8000
```

## 🔑 Тестовые Аккаунты

| Роль | Email | Пароль |
|------|-------|---------|
| Admin | admin@restoran.uz | admin123 |
| Customer | customer@restoran.uz | customer123 |

## 📚 Основные Routes

```
PUBLIC:
GET  /                      Главная
GET  /menu                  Меню
GET  /register, /login      Авторизация

CUSTOMER (требуется auth):
GET  /dashboard             Личный кабинет
GET  /reservation/create    Форма бронирования
POST /reservation           Создать брось

ADMIN (требуется admin):
GET  /admin/dashboard       Панель управления
GET  /admin/categories      Категории
GET  /admin/foods           Блюда
GET  /admin/tables          Столы
GET  /admin/reservations    Резервирования
GET  /admin/orders          Заказы
```

## 🎨 Дизайн

- 🟠 Primary Color: `#f59e0b` (Amber-600)
- ⚫ Dark Text: `#1f2937` (Gray-900)
- ⚪ Light BG: `#f5f5f4` (Stone-50)
- 🔤 Fonts: Playfair Display (serif), Inter (sans-serif)
- 📱 Fully Responsive & Mobile-First

## 🗄️ База Данных

**Основные таблицы:**
- `users` - Пользователи (админ/клиент)
- `categories` - Категории блюд
- `foods` - Блюда меню
- `tables` - Столы ресторана
- `reservations` - Резервирования
- `orders` - Заказы
- `order_items` - Позиции в заказах

**Миграции:** `database/migrations/`
**Seeders:** `database/seeders/`

## 📖 Полная Документация

Смотрите **PROJECT_DOCUMENTATION.md** для подробного описания:
- Архитектуры системы
- Каждого контроллера, модели, view
- Процессов бизнес-логики
- Схемы базы данных
- Расширений и улучшений

## 🐛 Полезные Команды

```bash
# Миграции
php artisan migrate              # Создать таблицы
php artisan migrate:fresh        # Пересоздать (ОПАСНО!)
php artisan migrate:rollback     # Откатить

# Seeders
php artisan db:seed             # Заполнить тестовыми данными

# Очистка кэша
php artisan cache:clear && php artisan config:clear

# Тесты
php artisan test
```

## 🌍 Язык & Локализация

- ✅ Полностью на **Узбекском** языке
- Валюта: **so'm** (узбекский сум)
- Все интерфейсы, сообщения и формы на узбекском

## 📄 License

MIT License

## 👨‍💻 Разработчик

Создано с ❤️ для Grand Restoran, Toshkent

---

**Вопросы?** Смотрите PROJECT_DOCUMENTATION.md или создавайте Issues

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
