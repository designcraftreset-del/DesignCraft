# Полная пошаговая инструкция: DesignCraft на Render

Всё в одном месте: переменные окружения, деплой, перенос БД (с ПК и изнутри Render), создание админа.

---

## Часть 1. Переменные окружения на Render

Откройте: **Dashboard Render** → ваш **Web Service** → **Environment** → **Add Environment Variable**.

Добавьте **каждую** переменную из таблицы (Key и Value).

| Key | Value (подставьте свои данные) |
|-----|----------------------------------|
| `APP_NAME` | `DesignCraft` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_KEY` | Результат команды в папке проекта: `php artisan key:generate --show` |
| `APP_URL` | `https://designcraft-xej3.onrender.com` (или ваш URL из Render) |
| `DB_CONNECTION` | `pgsql` |
| `DATABASE_URL` | **Internal Database URL** из карточки PostgreSQL (Dashboard → Databases → ваша база → Connect → Internal Database URL) |
| `LOG_CHANNEL` | `stack` |
| `LOG_LEVEL` | `warning` |
| `CACHE_DRIVER` | `file` |
| `SESSION_DRIVER` | `file` |
| `QUEUE_CONNECTION` | `sync` |
| `MAIL_MAILER` | `smtp` |
| `MAIL_HOST` | `smtp.gmail.com` |
| `MAIL_PORT` | `587` |
| `MAIL_USERNAME` | `designcraftreset@gmail.com` |
| `MAIL_PASSWORD` | пароль приложения Gmail (не обычный пароль) |
| `MAIL_ENCRYPTION` | `tls` |
| `MAIL_FROM_ADDRESS` | `designcraftreset@gmail.com` |
| `MAIL_FROM_NAME` | `DesignCraft` |

Ссылка на Environment: https://dashboard.render.com/web/srv-d6fm2q95pdvs73djbl90/env

---

## Часть 2. Первый деплой

1. В корне проекта (где лежит `artisan`) выполните:
   ```powershell
   cd c:\ospanel\domains\DesignCraft
   git add .
   git commit -m "Deploy to Render"
   git push origin main
   ```
2. В Render: **New → Web Service** (если ещё не создан), подключите репозиторий.
3. **Runtime:** Docker. **Branch:** main. Build/Start Command — пусто.
4. В **Environment** добавьте все переменные из Части 1, включая `DATABASE_URL`.
5. **Create Web Service**. Дождитесь сборки (5–10 минут).
6. Сайт: `https://designcraft-xej3.onrender.com` (или ваш URL из карточки сервиса).

---

## Часть 3. Перенос базы данных на Render

Есть два способа. Если с ПК импорт обрывается («server closed the connection») — используйте **вариант B**.

---

### Вариант A. Импорт с вашего ПК

**Шаг A1. Экспорт локальной БД в JSON**

В папке проекта (подключение в .env к вашей локальной MySQL/OSPanel):

```powershell
cd c:\ospanel\domains\DesignCraft
php artisan db:export
```

Появится папка `storage\app\db-export` с файлами: `users.json`, `applications.json` и т.д.

**Если у вас только файл .sql (дамп MySQL):**

```powershell
cd c:\ospanel\domains\DesignCraft
php artisan db:import-from-sql storage\app\xkgdykj-m1.sql
```

(или путь к вашему .sql в кавычках, например `"c:\Users\Иван\Downloads\xkgdykj-m1 (1).sql"`). После этого в `storage\app\db-export` появятся JSON.

**Шаг A2. Подключить .env к базе Render**

1. Render → **Databases** → ваша PostgreSQL → скопировать **External Database URL**.
2. В файле `c:\ospanel\domains\DesignCraft\.env` прописать:
   ```env
   DB_CONNECTION=pgsql
   DATABASE_URL=postgresql://USER:PASSWORD@dpg-xxxxx.frankfurt-postgres.render.com/DATABASE?sslmode=require
   ```
   (подставьте скопированный URL целиком, в одну строку).
3. В карточке **PostgreSQL** на Render: **Allow connections from** — добавить ваш IP (узнать: https://ifconfig.me), формат `123.45.67.89/32`.

**Шаг A3. Импорт**

```powershell
cd c:\ospanel\domains\DesignCraft
php artisan db:import --force
```

**Шаг A4. После импорта**

Верните в `.env` локальное подключение к MySQL (закомментируйте `DATABASE_URL`, выставьте `DB_CONNECTION=mysql` и т.д.), если снова работаете локально.

---

### Вариант B. Импорт изнутри Render (без Shell)

Используйте, если с ПК команда `db:import --force` обрывается.

**Шаг B1. Создать JSON-экспорт локально**

```powershell
cd c:\ospanel\domains\DesignCraft
php artisan db:export
```

Либо, если есть только .sql:

```powershell
php artisan db:import-from-sql storage\app\xkgdykj-m1.sql
```

В обоих случаях в `storage\app\db-export` появятся JSON-файлы.

**Шаг B2. Скопировать JSON в папку репозитория**

Скопируйте **все файлы** из папки:

- `c:\ospanel\domains\DesignCraft\storage\app\db-export\`

в папку:

- `c:\ospanel\domains\DesignCraft\database\db-export\`

В результате в проекте должны быть файлы:

- `database\db-export\users.json`
- `database\db-export\applications.json`
- `database\db-export\reviews.json`
- и остальные по таблицам (как в `storage\app\db-export`).

**Шаг B3. Закоммитить и запушить**

```powershell
cd c:\ospanel\domains\DesignCraft
git add database/db-export/
git commit -m "Add db export for Render import"
git push origin main
```

**Шаг B4. Добавить токен на Render**

1. Render → ваш **Web Service** → **Environment**.
2. **Add Environment Variable:**
   - Key: `IMPORT_DB_TOKEN`
   - Value: любой секрет, например `importSecret456` (запомните его).

**Шаг B5. Дождаться деплоя и вызвать импорт один раз**

После того как деплой завершится, откройте в браузере (подставьте свой URL сайта и свой токен):

```
https://designcraft-xej3.onrender.com/import-db?token=importSecret456
```

Страница вернёт текст с отчётом: какие таблицы импортированы и сколько строк. Импорт выполняется на стороне Render (подключение к PostgreSQL внутреннее).

**Шаг B6. После успешного импорта**

1. В **Environment** Render удалите переменную `IMPORT_DB_TOKEN`.
2. По желанию: удалите маршрут `/import-db` из `routes\web.php` и при следующем деплое можно убрать или очистить папку `database\db-export` в репозитории.

---

## Часть 4. Создание админа на Render (Free — без Shell)

**Шаг 1.** В **Environment** Web Service добавьте переменную:

- Key: `SETUP_ADMIN_TOKEN`
- Value: любой секрет, например `mySecret123` (запомните).

**Шаг 2.** Сохраните, дождитесь деплоя (или сделайте Manual Deploy).

**Шаг 3.** Откройте в браузере один раз (подставьте свой URL и свой токен):

```
https://designcraft-xej3.onrender.com/setup-admin?token=mySecret123
```

Будет создан админ:

- **Логин (email):** `ii5543135@gmail.com`
- **Пароль:** `ii5543135@gmail.com`

**Шаг 4.** После этого удалите переменную `SETUP_ADMIN_TOKEN` из Environment. По желанию можно удалить маршрут `/setup-admin` из `routes\web.php`.

---

## Часть 5. Обновление сайта после изменений в коде

В папке проекта:

```powershell
cd c:\ospanel\domains\DesignCraft
git add .
git commit -m "Описание изменений"
git push origin main
```

При включённом **Auto-Deploy** на Render через 1–2 минуты начнётся сборка; после неё сайт обновится.

Либо: Render → ваш Web Service → **Manual Deploy** → **Deploy latest commit**.

---

## Краткая шпаргалка

| Действие | Команда или шаг |
|----------|------------------|
| Переменные хоста | Environment Web Service (см. Часть 1) |
| Деплой | `git push origin main` (при включённом Auto-Deploy) |
| Экспорт БД локально | `php artisan db:export` или `php artisan db:import-from-sql "путь\к\файлу.sql"` |
| Импорт с ПК | В .env прописать External DATABASE_URL → `php artisan db:import --force` |
| Импорт изнутри Render | JSON в `database/db-export` → push → в Environment добавить `IMPORT_DB_TOKEN` → открыть `/import-db?token=...` один раз |
| Создать админа | В Environment добавить `SETUP_ADMIN_TOKEN` → открыть `/setup-admin?token=...` один раз |

---

## Важные замечания

- На Render **не используется** файл `.env` — только переменные в панели Environment.
- `DATABASE_URL` для Web Service должен быть **Internal** (из карточки PostgreSQL), не External.
- Файлы (аватарки, превью) на бесплатном тарифе между перезапусками не сохраняются; переносятся только данные в БД.
- Бесплатный инстанс «засыпает» после ~15 минут без запросов; первый запрос после простоя может идти 30–60 секунд.
