# Grand Restoran - Полная Документация Проекта

## 📋 Содержание
1. [Обзор Проекта](#обзор-проекта)
2. [Технологический Стек](#технологический-стек)
3. [Структура Проекта](#структура-проекта)
4. [Базовая Архитектура](#базовая-архитектура)
5. [Детальное Описание Файлов](#детальное-описание-файлов)
6. [Функциональность по Модулям](#функциональность-по-модулям)
7. [Установка и Запуск](#установка-и-запуск)

---

## 🍽️ Обзор Проекта

**Grand Restoran** - это полнофункциональная веб-платформа управления премиальным рестораном на базе Laravel 12.

### Основные Возможности:
- 👥 **Система Авторизации** - Регистрация, вход, управление профилем
- 📋 **Меню и Каталог** - 150+ блюд, организованных по категориям
- 📅 **Система Бронирования** - Заказ столов, управление резервациями
- 🛒 **Система Заказов** - Размещение заказов, отслеживание статуса
- 👨‍💼 **Админ-Панель** - Полное управление рестораном (столы, блюда, заказы, бронирования)
- 📊 **Dashboard** - Статистика, история операций, профиль пользователя
- 🎨 **Премиальный UI** - Современный, красивый интерфейс с Tailwind CSS

### Целевая Аудитория:
- **Клиенты** - Посетители ресторана (регистрация, просмотр меню, бронирование, заказы)
- **Администраторы** - Управление всеми аспектами ресторана

---

## 🛠️ Технологический Стек

### Backend:
```
- Laravel 12 (PHP MVC Framework)
- PHP 8.2+
- SQLite (база данных)
- Eloquent ORM (работа с БД)
```

### Frontend:
```
- Blade Templating (шаблоны Laravel)
- Tailwind CSS 3 (утилит-фёрст CSS)
- Alpine.js (лёгкий JavaScript фреймворк)
- Vite (сборщик модулей)
```

### Дополнительно:
```
- Composer (менеджер зависимостей PHP)
- Node.js + npm (для фронтенда)
- Git (контроль версий)
```

### Шрифты и Дизайн:
```
- Playfair Display (элегантный serif для заголовков)
- Inter (чистый sans-serif для текста)
- Цветовая схема: Amber (#f59e0b) + Gray
```

---

## 📁 Структура Проекта

```
restaran/
├── app/                           # Основной код приложения
│   ├── Http/
│   │   ├── Controllers/           # Контроллеры обработки запросов
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php      # Admin Dashboard
│   │   │   │   ├── CategoryController.php       # CRUD категорий
│   │   │   │   ├── FoodController.php           # CRUD блюд
│   │   │   │   ├── TableController.php          # CRUD столов
│   │   │   │   ├── OrderController.php          # CRUD заказов
│   │   │   │   └── ReservationController.php    # Управление резервациями
│   │   │   └── Auth/
│   │   │       ├── RegisteredUserController.php # Регистрация
│   │   │       ├── AuthenticatedSessionController.php
│   │   │       └── PasswordResetLinkController.php
│   │   ├── Middleware/            # Middleware (фильтры запросов)
│   │   │   ├── Authenticate.php   # Проверка авторизации
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   └── AdminMiddleware.php # Проверка прав администратора
│   │   └── Requests/              # Form Request Validation
│   │
│   ├── Models/                    # Eloquent модели (представление таблиц)
│   │   ├── User.php               # Пользователь (клиент или админ)
│   │   ├── Category.php           # Категория блюд
│   │   ├── Food.php               # Блюдо
│   │   ├── Table.php              # Стол в ресторане
│   │   ├── Reservation.php        # Резервация стола
│   │   ├── Order.php              # Заказ
│   │   └── OrderItem.php          # Позиция в заказе
│   │
│   ├── Policies/                  # Authorization Policies
│   └── Providers/                 # Service Providers
│
├── database/                      # БД файлы
│   ├── migrations/                # Миграции (создание таблиц)
│   │   ├── 2024_01_01_create_users_table.php
│   │   ├── 2024_01_01_create_categories_table.php
│   │   ├── 2024_01_01_create_foods_table.php
│   │   ├── 2024_01_01_create_tables_table.php
│   │   ├── 2024_01_01_create_reservations_table.php
│   │   ├── 2024_01_01_create_orders_table.php
│   │   └── 2024_01_01_create_order_items_table.php
│   ├── seeders/                   # Seeders (заполнение тестовых данных)
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── CategorySeeder.php
│   │   └── ...
│   └── database.sqlite            # SQLite база данных
│
├── resources/                     # Frontend ресурсы
│   ├── views/                     # Blade шаблоны HTML
│   │   ├── home.blade.php                    # Главная страница
│   │   ├── menu.blade.php                    # Страница меню
│   │   ├── reservation.blade.php             # Форма бронирования
│   │   ├── dashboard.blade.php               # Customer Dashboard
│   │   ├── layouts/
│   │   │   ├── customer.blade.php            # Layout для клиентов
│   │   │   ├── guest.blade.php               # Layout для гостей
│   │   │   └── app.blade.php                 # Admin Layout
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php           # Admin Dashboard
│   │   │   ├── layouts/
│   │   │   │   └── app.blade.php             # Admin главный layout
│   │   │   ├── categories/                   # Страницы управления категориями
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── foods/                        # Страницы управления блюдами
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── tables/                       # Страницы управления столами
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── reservations/                 # Страницы резервирования
│   │   │   │   ├── index.blade.php
│   │   │   │   └── show.blade.php
│   │   │   └── orders/                       # Страницы заказов
│   │   │       ├── index.blade.php
│   │   │       ├── create.blade.php
│   │   │       └── show.blade.php
│   │   ├── auth/                             # Страницы авторизации
│   │   │   ├── login.blade.php
│   │   │   ├── register.blade.php
│   │   │   ├── forgot-password.blade.php
│   │   │   └── reset-password.blade.php
│   │   ├── profile/                          # Профиль пользователя
│   │   │   ├── edit.blade.php
│   │   │   └── partials/
│   │   └── components/                       # Blade компоненты
│   │       ├── input-label.blade.php
│   │       ├── text-input.blade.php
│   │       ├── input-error.blade.php
│   │       └── primary-button.blade.php
│   │
│   ├── css/
│   │   └── app.css                           # Основной CSS файл
│   │
│   └── js/
│       ├── app.js                            # Основной JS файл
│       └── bootstrap.js                      # Bootstrap JS
│
├── routes/                        # Маршруты приложения
│   ├── web.php                    # Web маршруты (главный файл)
│   ├── api.php                    # API маршруты (если нужны)
│   └── auth.php                   # Auth маршруты (регистрация, логин)
│
├── public/                        # Публичные файлы (доступны из браузера)
│   ├── index.php                  # Entry point приложения
│   ├── css/                       # Скомпилированные CSS файлы
│   ├── js/                        # Скомпилированные JS файлы
│   ├── images/                    # Изображения
│   └── favicon.ico
│
├── config/                        # Конфигурационные файлы
│   ├── app.php                    # Основные настройки приложения
│   ├── database.php               # Настройки БД
│   ├── auth.php                   # Настройки авторизации
│   └── ...
│
├── storage/                       # Хранилище файлов
│   ├── logs/                      # Логи приложения
│   ├── app/                       # Пользовательские файлы
│   └── framework/
│
├── tests/                         # Тесты приложения
│   ├── Feature/                   # Feature тесты
│   └── Unit/                      # Unit тесты
│
├── .env                           # Переменные окружения (НЕ коммитить!)
├── .env.example                   # Пример .env файла
├── composer.json                  # PHP зависимости
├── package.json                   # Node.js зависимости
├── vite.config.js                 # Конфигурация Vite
├── tailwind.config.js             # Конфигурация Tailwind CSS
├── artisan                        # CLI для Laravel команд
└── README.md                      # Документация проекта
```

---

## 🏗️ Базовая Архитектура

### MVC Паттерн (Model-View-Controller)

```
┌─────────────────────────────────────────────────┐
│              REQUESTS (Браузер)                 │
└────────────────────┬────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────┐
│            ROUTES (routes/web.php)              │
│  Определяет какой контроллер обработать запрос │
└────────────────────┬────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────┐
│          CONTROLLERS (app/Http/Controllers)     │
│  Обрабатывает бизнес-логику, получает данные   │
└────────────────────┬────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────┐
│              MODELS (app/Models)                │
│  Работает с БД через Eloquent ORM              │
└────────────────────┬────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────┐
│         DATABASE (database/database.sqlite)     │
│  Хранилище данных - таблицы, записи             │
└────────────────────┬────────────────────────────┘
                     │
              (вверх по цепи)
                     │
                     ▼
┌─────────────────────────────────────────────────┐
│              VIEWS (resources/views)            │
│  Blade шаблоны - отображение данных для User   │
└────────────────────┬────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────┐
│            RESPONSE (HTML/CSS/JS)               │
│         Браузер отображает страницу             │
└─────────────────────────────────────────────────┘
```

### Схема Базы Данных

```
┌──────────────────────────────────────────────────────────┐
│                    USERS (Пользователи)                  │
├──────────────────────────────────────────────────────────┤
│ id | name | email | phone | password | role_id | ...    │
└──────────────────┬───────────────────────────────────────┘
                   │
        ┌──────────┼──────────┐
        │          │          │
        ▼          ▼          ▼
    ┌─────────┐ ┌──────────────┐ ┌──────────────┐
    │ORDERS   │ │RESERVATIONS  │ │ADMIN ONLY    │
    └─────────┘ └──────────────┘ └──────────────┘
        │              │
    ┌───┴───┐      ┌────┴─────┐
    │       │      │          │
    ▼       ▼      ▼          ▼
 ┌──────────────┐ ┌────────────────┐ ┌──────────────┐
 │  ORDER ITEMS │ │   FOODS        │ │  TABLES      │
 │ (позиции)    │ │ (блюда меню)   │ │ (столы)      │
 └──────────────┘ └────┬───────────┘ └──────────────┘
                       │
                       ▼
                 ┌──────────────┐
                 │ CATEGORIES   │
                 │(категории)   │
                 └──────────────┘
```

---

## 📄 Детальное Описание Файлов

### 🎯 Controllers (app/Http/Controllers/)

#### `Admin/DashboardController.php`
**Назначение:** Отображение админ-панели с статистикой
**Методы:**
- `index()` - Собирает статистику (выручка, заказы, резервации, столы), передаёт в view

**Логика:**
```php
// Получает статистику за сегодня
$today_revenue = Order::where('payment_status','paid')
                  ->whereDate('created_at', Carbon::today())
                  ->sum('total_amount');

// Получает последние заказы и резервации
$recentOrders = Order::with(['user','table'])->latest()->take(5)->get();
```

---

#### `Admin/CategoryController.php`
**Назначение:** Управление категориями блюд (Create, Read, Update, Delete)
**Методы:**
- `index()` - Список всех категорий с подсчётом количества блюд
- `create()` - Форма создания новой категории
- `store(Request)` - Сохранение новой категории в БД
- `edit(Category)` - Форма редактирования
- `update(Request, Category)` - Обновление в БД
- `destroy(Category)` - Удаление из БД

**Валидация:**
```
name: required|string|max:255|unique
slug: auto-generated
```

---

#### `Admin/FoodController.php`
**Назначение:** Управление блюдами в меню
**Методы:**
- `index()` - Список всех блюд с категориями (paginated)
- `create()` - Форма создания блюда
- `store(Request)` - Сохранение блюда
- `edit(Food)` - Форма редактирования
- `update(Request, Food)` - Обновление
- `destroy(Food)` - Удаление

**Валидация:**
```
category_id: required|exists:categories,id
name: required|string|max:255
description: nullable|string
price: required|numeric|min:0
is_available: boolean
```

---

#### `Admin/TableController.php`
**Назначение:** Управление столами в ресторане
**Методы:**
- `index()` - Список столов с группировкой по статусам
- `create()` - Форма создания стола
- `store(Request)` - Сохранение
- `edit(Table)` - Редактирование
- `update(Request, Table)` - Обновление
- `destroy(Table)` - Удаление

**Статусы стола:**
```
available   - стол свободен
reserved    - стол забронирован
occupied    - стол занят клиентом
```

---

#### `Admin/ReservationController.php`
**Назначение:** Управление бронированиями столов
**Методы:**
- `index()` - Список резервирований с фильтрацией (по статусу, дате)
- `show(Reservation)` - Детали резервации
- `update(Request, Reservation)` - Изменение статуса
- `destroy(Reservation)` - Отмена резервации

**Статусы резервации:**
```
pending    - в ожидании подтверждения
confirmed  - подтверждена
completed  - завершена
cancelled  - отменена
```

---

#### `Admin/OrderController.php`
**Назначение:** Управление заказами
**Самый сложный контроллер!**
**Методы:**
- `index()` - Список заказов с фильтрацией
- `create()` - Форма создания заказа (выбор блюд, стола)
- `store(Request)` - Сохранение заказа с позициями
- `show(Order)` - Детали заказа с позициями
- `update(Request, Order)` - Изменение статуса/оплаты
- `destroy(Order)` - Удаление заказа (cascade удаляет OrderItems)

**Уникальная логика:**
```php
// При создании заказа:
1. Получить список блюд из запроса (food_id + quantity)
2. Для каждого блюда получить текущую цену из БД
3. Рассчитать общую сумму (цена × количество)
4. Создать заказ
5. Создать все OrderItems к этому заказу
```

---

#### `Auth/RegisteredUserController.php`
**Назначение:** Регистрация новых пользователей
**Методы:**
- `create()` - Форма регистрации
- `store(Request)` - Сохранение нового пользователя

**Логика:**
```php
// Валидирует данные
// Хеширует пароль (не хранит в открытом виде!)
// Создаёт User с role_id = 2 (клиент)
// Автоматически логирует пользователя
// Редирект на dashboard
```

---

### 📊 Models (app/Models/)

#### `User.php`
```php
// Связи
- orders() hasMany Order          // один пользователь - много заказов
- reservations() hasMany Reservation  // много резервирований

// Свойства
id, name, email, phone, password, role_id, email_verified_at, created_at

// Role ID:
1 = Administrator (админ)
2 = Customer (клиент)
```

#### `Category.php`
```php
// Связи
- foods() hasMany Food            // категория - много блюд

// Свойства
id, name, slug, created_at
```

#### `Food.php`
```php
// Связи
- category() belongsTo Category   // блюдо принадлежит категории
- orderItems() hasMany OrderItem  // блюдо в много позициях заказов

// Свойства
id, category_id, name, description, price, is_available
```

#### `Table.php`
```php
// Связи
- reservations() hasMany Reservation
- orders() hasMany Order

// Свойства
id, name, capacity, status, location, created_at
```

#### `Reservation.php`
```php
// Связи
- user() belongsTo User
- table() belongsTo Table

// Свойства
id, user_id, table_id, reservation_date, guests_count, status, notes
```

#### `Order.php`
```php
// Связи
- user() belongsTo User
- table() belongsTo Table nullable  // может быть без стола (delivery?)
- orderItems() hasMany OrderItem

// Свойства
id, user_id, table_id, total_amount, status, payment_status, created_at
```

#### `OrderItem.php`
```php
// Связи
- order() belongsTo Order
- food() belongsTo Food

// Свойства
id, order_id, food_id, quantity, price (цена в момент заказа)
```

---

### 👁️ Views (resources/views/)

#### **Customer-Facing Pages:**

##### `home.blade.php` - Главная страница
**Структура:**
```
1. Navigation Bar (Фиксированная)
   - Логотип Grand Restoran
   - Ссылки: Bosh sahifa, Menyu, Joy band qilish
   - Auth buttons: Kirish / Registratsiya

2. Hero Section (min-h-screen)
   - Большой заголовок "Kulinariya Xudosi"
   - Статистика (20+ лет, 1000+ клиентов, 150+ блюд)
   - CTA кнопки: Joy band qilish, Menyuni ko'ring

3. Featured Foods (3 карточки)
   - Lamb Plov (45,000 so'm)
   - Manto (35,000 so'm)
   - Shorva (28,000 so'm)

4. About Section
   - Информация о ресторане
   - 2x2 сетка эмодзи (👨‍🍳, 🍽️, 🎖️, 💚)

5. Features Section (4 колонки)
   - Premium Sifat
   - Tabiiy va Sog'lom
   - Tez Xizmat
   - Sevgi bilan

6. CTA Banner
   - Большое предложение с кнопками

7. Footer
   - Контакты, график работы, соцсети
```

---

##### `menu.blade.php` - Меню ресторана
**Структура:**
```
1. Navigation Bar
2. Hero: "Bizning Menyu" (150+ Ta'om Turi)
3. Menu Categories Loop
   - Для каждой категории (Первые блюда, Основные, etc.)
   - Header с названием категории и числом блюд
   - Grid 3 карточек блюд в строке:
     * Иконка блюда (эмодзи)
     * Название + описание
     * Цена и кнопка заказа
     * Статус: Mavjud / Tugadi
4. Footer
```

---

##### `reservation.blade.php` - Форма бронирования
**Структура:**
```
1. Navigation Bar
2. Hero: "Stol Band Qilish - Sizning Vaqtingiz"
3. Form (4 шага)
   Step 1: Stol Tanlash (select из доступных столов)
   Step 2: Sana (date input)
   Step 3: Vaqt (time input)
   Step 4: Mehmonlar Soni (number 1-20)
   Step 5: Qo'shimcha Izohlar (textarea)
4. Submit Button: "Broningizni Tasdiqlang"
5. Info Cards (внизу):
   - Tez Tasdiqlash
   - Oddiy Jarayon
   - Maxsus Imkoniyatlar
6. Footer
```

---

##### `dashboard.blade.php` - Customer Dashboard
**Структура:**
```
1. Navigation Bar
2. Header Banner (gradient amber)
   - Greeting: "Assaliomu Aleykum, {Name}!"
   - Account ID: #{id}

3. Stats Cards (4 шт)
   - Email
   - Phone
   - Jami Zakazlar (count)
   - Jami Bronlar (count)

4. Quick Actions (3 карточки)
   - Menyu Ko'rish
   - Joy Band Qilish
   - Profilni O'zgartirish

5. Recent Orders (таблица)
   - Заказ #ID, дата, цена, статус
   - Max 5 строк, скролл

6. Recent Reservations (таблица)
   - Стол, дата/время, количество, статус
   - Max 5 строк, скролл

7. Footer
```

---

#### **Admin Pages:**

##### `admin/dashboard.blade.php` - Admin Dashboard
**Структура:**
```
1. Sidebar Navigation (Alpine.js toggle на мобильных)
   - Dashboard, Kategoriyalar, Taomlar, Stollar
   - Rezervatsiyalar, Zakazlar
   - Admin info: имя, email, время сеанса

2. Top Stats (4 карточки - СЕГОДНЯ)
   - Bugungi Daromad (Today Revenue)
   - Bugungi Zakazlar (Today Orders)
   - Bugungi Rezervatsiyalar (Today Reservations)
   - Bo'sh Stollar (Available Tables)

3. Secondary Stats (4 карточки - ВСЕГО)
   - Jami Zakazlar
   - Kutilayotgan Zakazlar (Pending)
   - Jami Rezervatsiyalar
   - Jami Mijozlar

4. Recent Orders (таблица)
   - ID, Customer, Table, Amount, Status, Date

5. Recent Reservations (таблица)
   - Table, Guest, Date, Time, Guests Count, Status
```

---

##### `admin/categories/index.blade.php`
**Структура:**
```
1. Page Header + "Kategoriya Qo'shish" кнопка
2. Search/Filter (опционально)
3. Table:
   Columns: ID | Nomi | Slug | Taomlar soni | Amallar (Edit/Delete)
4. Pagination
```

---

##### `admin/foods/index.blade.php`
**Структура:**
```
1. Page Header + "Taom Qo'shish" кнопка
2. Filter by Category (опционально)
3. Table:
   Columns: ID | Taom Nomi | Kategoriya | Narx | Holat | Amallar
4. Pagination
```

---

##### `admin/tables/index.blade.php`
**Структура:**
```
1. Summary row (статус сводка)
   - Bo'sh Stollar: X
   - Band Stollar: Y
   - To'liq Stollar: Z

2. Page Header + "Stol Qo'shish" кнопка
3. Table:
   Columns: ID | Nomi | Sig'im | Joylashuv | Holat | Amallar
4. Pagination
```

---

##### `admin/orders/index.blade.php`
**Структура:**
```
1. Summary row (статистика)
   - Jami Zakazlar
   - Kutilayotgan
   - Jarayonda
   - Bajarilgan

2. Page Header + "Yangi Zakaz" кнопка
3. Table:
   Columns: ID | Mijoz | Stol | Jami (сумма) | To'lov | Holat | Amallar
4. Pagination
```

---

##### `admin/orders/create.blade.php` - СЛОЖНАЯ СТРАНИЦА
**Структура:**
```
1. Form Header: "Yangi Zakaz Yaratish"
2. Section 1: Zakazni Tanlash
   - Table Select (опционально - null для delivery)
   - Payment Status Select (unpaid/paid)
3. Section 2: Taomlarni Qo'shish (Dynamic)
   - Alpine.js x-for loop для динамического добавления строк
   - Каждая строка:
     * Food Select (dropdown со всеми таомами)
     * Quantity (number input)
     * Price (auto-filled из БД, readonly)
     * Line Total (price × quantity, автопересчёт)
   - Button: "Yangi Taom Qo'shish"
4. Total Calculation
   - Avtomatik summa всех позиций
   - Live update при изменении
5. Submit Button: "Zakaz Yaratish"

Alpine.js логика:
- x-data="orderForm()"
- foods data (ID → Price mapping)
- addFood(), removeFood() методы
- Автоматический пересчёт total
```

---

##### `admin/orders/show.blade.php`
**Структура:**
```
1. Header: "Zakaz #ID"
2. Left Column (70%)
   - Order Items Table
     Columns: Taom | Narx | Miqdor | Jami
   - Total Amount (большой шрифт)
3. Right Column (30%)
   - Customer Info (name, email, phone)
   - Table Info (table name, capacity)
   - Order Meta (created at, status, payment)
   - Action Buttons
     * Change Status (select + submit)
     * Change Payment Status (select + submit)
     * Delete Order (confirm)
```

---

##### `admin/reservations/index.blade.php`
**Структура:**
```
1. Filters
   - Status filter (pending, confirmed, completed, cancelled)
   - Date filter
2. Table:
   Columns: ID | Mijoz | Tel | Stol | Sana | Vaqt | Mehmonlar | Holat | Amallar
3. Pagination
```

---

##### `admin/reservations/show.blade.php`
**Структура:**
```
1. Header: "Rezervatsiya Detallari"
2. Left Column
   - Customer Info
   - Table Info
   - Date/Time Info
   - Guests Count
   - Notes
3. Right Column
   - Status Change Form (select + submit)
   - Confirmation Modal
4. Delete Button
```

---

### 🔐 Routes (routes/web.php)

```php
// PUBLIC ROUTES (без авторизации)
GET  /                          → home
GET  /menu                      → menu
GET  /register                  → registration form
POST /register                  → store new user
GET  /login                     → login form
POST /login                     → authenticate user
GET  /forgot-password           → forgot password form

// CUSTOMER ROUTES (требуется авторизация)
Route::middleware('auth')->group(function () {
    GET  /dashboard             → customer dashboard
    POST /logout                → logout
    GET  /profile               → profile edit form
    PATCH /profile              → update profile

    // Бронирование
    GET  /reservation/create    → reservation form
    POST /reservation           → store reservation

    // Заказы (если есть функция для клиентов)
    GET  /orders                → order history
});

// ADMIN ROUTES (требуется auth + role_id == 1)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    GET  /dashboard             → admin dashboard

    // Categories
    GET  /categories            → categories list
    GET  /categories/create     → create form
    POST /categories            → store
    GET  /categories/{id}/edit  → edit form
    PATCH /categories/{id}      → update
    DELETE /categories/{id}     → delete

    // Foods
    GET  /foods                 → foods list
    GET  /foods/create          → create form
    POST /foods                 → store
    GET  /foods/{id}/edit       → edit form
    PATCH /foods/{id}           → update
    DELETE /foods/{id}          → delete

    // Tables
    GET  /tables                → tables list
    GET  /tables/create         → create form
    POST /tables                → store
    GET  /tables/{id}/edit      → edit form
    PATCH /tables/{id}          → update
    DELETE /tables/{id}         → delete

    // Reservations
    GET  /reservations          → reservations list
    GET  /reservations/{id}     → show details
    PATCH /reservations/{id}    → update status
    DELETE /reservations/{id}   → delete

    // Orders
    GET  /orders                → orders list
    GET  /orders/create         → create form
    POST /orders                → store
    GET  /orders/{id}           → show details
    PATCH /orders/{id}          → update status/payment
    DELETE /orders/{id}         → delete
});
```

---

## 🎯 Функциональность по Модулям

### 1️⃣ **Система Авторизации**

**Файлы:**
- `app/Http/Controllers/Auth/RegisteredUserController.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/layouts/guest.blade.php`

**Процесс Регистрации:**
```
1. Пользователь переходит на /register
2. Заполняет форму (name, phone, email, password)
3. Валидируется на сервере:
   - name: required, string, max:255
   - email: required, unique в БД
   - phone: nullable, max:20
   - password: required, min:8
4. Пароль хеширется (bcrypt)
5. Создаётся User с role_id = 2 (customer)
6. Пользователь автоматически логируется
7. Редирект на dashboard
```

**Процесс Входа:**
```
1. Пользователь заходит на /login
2. Вводит email + password
3. Laravel проверяет в БД
4. Если совпадает → создаёт сеанс (session)
5. Редирект на главную или dashboard
```

---

### 2️⃣ **Меню и Категории**

**Файлы:**
- `app/Models/Category.php`
- `app/Models/Food.php`
- `app/Http/Controllers/Admin/CategoryController.php`
- `app/Http/Controllers/Admin/FoodController.php`
- `resources/views/menu.blade.php`
- `resources/views/admin/categories/*`
- `resources/views/admin/foods/*`

**Структура данных:**
```
Categories (Категории)
├── 1: Первые блюда
│   ├── Food: Shorva (28,000)
│   └── Food: Masta'a (32,000)
├── 2: Основные блюда
│   ├── Food: Plov (45,000)
│   └── Food: Manto (35,000)
└── 3: Напитки
    ├── Food: Чай (5,000)
    └── Food: Компот (8,000)
```

**Admin функциональность:**
```
- Создавать/редактировать/удалять категории
- Создавать/редактировать/удалять блюда
- Отмечать блюда как доступные/недоступные
- Менять цены
```

---

### 3️⃣ **Система Бронирования**

**Файлы:**
- `app/Models/Table.php`
- `app/Models/Reservation.php`
- `app/Http/Controllers/Admin/TableController.php`
- `app/Http/Controllers/Admin/ReservationController.php`
- `resources/views/reservation.blade.php`
- `resources/views/admin/tables/*`
- `resources/views/admin/reservations/*`

**Процесс Бронирования:**
```
1. Customer переходит на /reservation/create
2. Выбирает:
   - Стол (из доступных столов)
   - Дату
   - Время
   - Количество гостей
   - Опциональные заметки
3. Валидируется:
   - Дата ≥ сегодня
   - Время в рабочее время (11:00-23:00)
   - Количество гостей ≤ capacity стола
4. Создаётся Reservation
5. Status = "pending" (ждёт подтверждения админом)
6. SMS отправляется (если интегрировано)

Admin функциональность:
- Видит все резервации
- Может фильтровать по статусу, дате
- Может подтвердить (confirmed)
- Может отменить (cancelled)
- Может отметить как завершённую (completed)
```

**Статусы столов:**
```
available  - свободен
reserved   - забронирован на определённое время
occupied   - занят клиентом прямо сейчас
```

---

### 4️⃣ **Система Заказов**

**Файлы:**
- `app/Models/Order.php`
- `app/Models/OrderItem.php`
- `app/Http/Controllers/Admin/OrderController.php`
- `resources/views/admin/orders/*`

**Процесс Создания Заказа (Admin):**
```
1. Admin переходит на /admin/orders/create
2. Выбирает стол (опционально - может быть delivery)
3. Выбирает платёж статус (unpaid/paid)
4. Динамически добавляет блюда:
   - Выбирает Food из select
   - Вводит Quantity
   - Цена автоматически подгружается
   - Сумма линии вычисляется (price × qty)
5. Общая сумма вычисляется динамически (Alpine.js)
6. Подтверждает заказ → создаётся Order
7. Для каждого блюда создаётся OrderItem

За кулисами:
- Order.total_amount = сумма всех позиций
- Order.status = 'pending'
- Order.payment_status = выбранный статус
- Каждый OrderItem сохраняет цену в момент заказа
  (в случае если позже цены поменялись)
```

**Статусы заказа:**
```
pending      - новый заказ
processing   - готовится
completed    - завершён
cancelled    - отменён
```

**Статусы оплаты:**
```
unpaid       - не оплачен
paid         - оплачен
```

**Admin функциональность:**
```
- Создавать заказы вручную
- Видеть все заказы с фильтрацией
- Менять статус заказа
- Менять статус оплаты
- Видеть историю (реестр всех заказов)
```

---

### 5️⃣ **Admin Dashboard**

**Файлы:**
- `app/Http/Controllers/Admin/DashboardController.php`
- `resources/views/admin/dashboard.blade.php`

**Статистика которую собирает:**

**Сегодня:**
```
- Bugungi Daromad (Today Revenue)
  SELECT SUM(total_amount) FROM orders
  WHERE payment_status='paid' AND DATE(created_at)=TODAY()

- Bugungi Zakazlar (Today Orders Count)
  SELECT COUNT(*) FROM orders WHERE DATE(created_at)=TODAY()

- Bugungi Rezervatsiyalar (Today Reservations)
  SELECT COUNT(*) FROM reservations
  WHERE DATE(reservation_date)=TODAY()

- Bo'sh Stollar (Available Tables)
  SELECT COUNT(*) FROM tables WHERE status='available'
```

**За всё время:**
```
- Jami Zakazlar (Total Orders)
- Kutilayotgan Zakazlar (Pending Orders)
- Jami Rezervatsiyalar (Total Reservations)
- Jami Mijozlar (Total Customers) - Users where role_id=2
```

**Последние записи:**
```
- Recent Orders (последние 5 заказов с пользователем и столом)
- Recent Reservations (последние 5 резервирований с пользователем и столом)
```

---

### 6️⃣ **Customer Dashboard**

**Файлы:**
- `resources/views/dashboard.blade.php`

**Показывает:**
```
1. Профиль пользователя
   - ID, имя, email, телефон

2. Быстрые ссылки
   - Меню
   - Забронировать стол
   - Редактировать профиль

3. История заказов
   - Последние 5 заказов
   - Дата, цена, статус

4. История резервирований
   - Последние 5 броней
   - Стол, дата/время, количество гостей, статус
```

---

## 🚀 Установка и Запуск

### Требования:
- PHP 8.2+
- Composer
- Node.js 16+
- npm/yarn
- Git

### Шаги Установки:

```bash
# 1. Клонировать репозиторий
git clone <repo-url>
cd restaran

# 2. Установить PHP зависимости
composer install

# 3. Установить Node зависимости
npm install

# 4. Копировать .env файл
cp .env.example .env

# 5. Сгенерировать APP_KEY
php artisan key:generate

# 6. Создать базу данных (миграции)
php artisan migrate

# 7. Заполнить БД тестовыми данными (seeders)
php artisan db:seed

# 8. Собрать фронтенд (Vite)
npm run build

# Для разработки с hot reload:
npm run dev

# 9. Запустить приложение
php artisan serve

# 10. Открыть в браузере
http://localhost:8000
```

### Тестовые Аккаунты:

```
Admin:
- Email: admin@restoran.uz
- Password: admin123
- Role: Administrator (role_id = 1)

Customer:
- Email: customer@restoran.uz
- Password: customer123
- Role: Customer (role_id = 2)
```

### Команды Разработки:

```bash
# Миграции
php artisan migrate              # Создать таблицы
php artisan migrate:fresh        # Пересоздать таблицы (ОПАСНО!)
php artisan migrate:rollback     # Откатить последнюю миграцию

# Seeders
php artisan db:seed             # Заполнить тестовыми данными
php artisan db:seed --class=UserSeeder  # Запустить конкретный seeder

# Очистка кэша
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Генерация моделей
php artisan make:model Post              # Создать модель
php artisan make:model Post -m           # С миграцией
php artisan make:model Post -mc          # С миграцией и контроллером

# Создание контроллеров
php artisan make:controller PostController
php artisan make:controller Admin/PostController  # С папкой

# Тесты
php artisan test
php artisan test tests/Feature/AuthTest.php
```

---

## 📈 Масштабирование и Развитие

### Возможные Улучшения:

```
1. Payment Integration
   - Stripe, PayMe, Click для онлайн оплаты

2. SMS/Email Notifications
   - Уведомления при брони, готовности заказа

3. Доставка (Delivery)
   - Отслеживание доставки
   - Выбор адреса доставки

4. Рейтинговая Система
   - Оценки блюд и ресторана
   - Отзывы

5. Личные Кабинеты
   - История трат
   - Избранные блюда
   - Персональные скидки

6. API для Мобильного Приложения
   - REST API endpoints
   - JWT авторизация

7. Аналитика и Отчёты
   - Графики продаж
   - Анализ популярности блюд
   - Отчёты по доходам

8. Работа с Персоналом
   - Управление поварами, официантами
   - График смен
```

---

**Документация Завершена! 🎉**

Для вопросов или уточнений обращайтесь к коду и комментариям в файлах.
