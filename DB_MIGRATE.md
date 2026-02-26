# Перенос локальной базы данных на Render (PostgreSQL)

Чтобы данные с вашего локального сайта (OSPanel, MySQL) оказались на сайте на Render, сделайте экспорт из MySQL и импорт в PostgreSQL на Render.

---

## Вариант A: Импорт из дампа MySQL (файл .sql из phpMyAdmin)

Если у вас уже есть дамп базы (например `xkgdykj-m1.sql` из phpMyAdmin):

1. Скопируйте файл в проект:
   ```bash
   copy "C:\Users\ВАШ_ЛОГИН\Downloads\xkgdykj-m1.sql" "storage\app\xkgdykj-m1.sql"
   ```
   Или положите любой путь к `.sql` в аргумент ниже.

2. Разберите дамп в JSON (в папке проекта, в PowerShell или cmd):
   ```bash
   node scripts/parse-mysql-dump.js "storage/app/xkgdykj-m1.sql"
   ```
   Появится папка **`storage/app/db-export`** с JSON по таблицам.

3. Дальше — как в варианте B: в `.env` укажите `DB_CONNECTION=pgsql` и `DATABASE_URL` от Render и выполните:
   ```bash
   php artisan db:import --force
   ```

Можно также использовать Artisan (когда PHP доступен в PATH):
```bash
php artisan db:import-from-sql "путь/к/файлу.sql"
```
Та же команда сгенерирует JSON в `storage/app/db-export`, после чего запустите `php artisan db:import --force`.

---

## Вариант B (шаг 1): Экспорт с локального сайта (у вас на компьютере)

В папке проекта (где есть `artisan`) выполните:

```bash
php artisan db:export
```

Команда создаст папку **`storage/app/db-export`** и положит туда по одному JSON-файлу на каждую таблицу (users.json, applications.json и т.д.).

---

## Шаг 2. Подключение к базе Render (для варианта B)

1. Зайдите в [dashboard.render.com](https://dashboard.render.com) → ваша база **designcraft-db** (PostgreSQL).
2. В блоке **Connect** скопируйте **External Database URL** (внешний URL для подключения с вашего ПК). Он выглядит так:
   ```
   postgresql://designcraft_db_user:ПАРОЛЬ@dpg-xxxx.frankfurt-postgres.render.com/designcraft_db?sslmode=require
   ```

---

## Шаг 3. Импорт в базу Render (с вашего компьютера), общий для A и B

Временно подставьте в **`.env`** подключение к Render (можно в конце файла или заменить строки БД):

```env
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://designcraft_db_user:ПАРОЛЬ@dpg-xxxx.frankfurt-postgres.render.com/designcraft_db?sslmode=require
```

Сохраните `.env`, затем в папке проекта выполните:

```bash
php artisan db:import --force
```

Флаг `--force` очищает таблицы на Render перед вставкой, чтобы не было дубликатов.

После импорта верните в `.env` обратно настройки локальной MySQL, если продолжаете работать локально.

---

## Шаг 4. Проверка на сайте

Откройте https://designcraft-xej3.onrender.com — пользователи, заказы и остальные данные из локальной БД должны отображаться.

---

## Важно

- **Пароли пользователей** переносятся как есть (хеши в таблице `users`). Вход под старыми логинами/паролями будет работать.
- **Файлы (аватарки, превью)** на Render не переносятся — только записи в БД. Ссылки на картинки могут вести на старые пути; загруженные на Render файлы будут храниться только до перезапуска контейнера (на бесплатном тарифе).
- Папку `storage/app/db-export` не коммитьте в Git (она уже в `.gitignore`).
