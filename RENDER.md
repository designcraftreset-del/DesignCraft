# Деплой DesignCraft на Render.com

Проект подготовлен к деплою на Render: Dockerfile, скрипт запуска, принудительный HTTPS. База на Render — **PostgreSQL**.

В этом гайде: первый деплой, переменные окружения, **как обновить сайт после изменений в коде** (раздел 4), перенос базы данных.

---

## Ваш сервис (текущая настройка)

| Параметр | Значение |
|----------|----------|
| **Сайт** | https://designcraft-xej3.onrender.com |
| **Репозиторий** | https://github.com/designcraftreset-del/DesignCraft (ветка `main`) |
| **Environment** | [Настройки окружения](https://dashboard.render.com/web/srv-d6fm2q95pdvs73djbl90/env) |
| **Auto-Deploy** | Включён (On Commit) — после `git push origin main` деплой запускается сам |
| **Runtime** | Docker, Dockerfile: `./Dockerfile` |
| **Регион** | Frankfurt (EU Central) |
| **Deploy Hook** | В Render: Settings → Build & Deploy → Deploy Hook. Секретный URL для запуска деплоя без push (например, из скрипта или CI). |

В **Environment** укажите `APP_URL=https://designcraft-xej3.onrender.com`.

---

## Про ваш .env

**Локально** в `.env` настроено:
- `APP_URL=http://designcraft` — для OSPanel.
- `DB_CONNECTION=pgsql` и закомментирован `DATABASE_URL` — для Render нужно подставлять свой URL.

**На хосте Render** файл `.env` не используется: все переменные задаются в панели Render. То есть для хоста «всё настроено» не в `.env`, а в **Environment** вашего Web Service. Ниже — что именно туда добавить и как залить текущую базу.

---

## 1. Переменные окружения на Render

Откройте раздел **Environment** вашего Web Service и задайте переменные (кнопка **Add Environment Variable**):

**Ссылка на настройки окружения:**  
[https://dashboard.render.com/web/srv-d6fm2q95pdvs73djbl90/env](https://dashboard.render.com/web/srv-d6fm2q95pdvs73djbl90/env)

| Key | Value |
|-----|--------|
| `APP_NAME` | DesignCraft |
| `APP_ENV` | production |
| `APP_DEBUG` | false |
| `APP_KEY` | Сгенерируйте: `php artisan key:generate --show` (в папке проекта) и вставьте сюда |
| `APP_URL` | https://designcraft-xej3.onrender.com |
| `DB_CONNECTION` | pgsql |
| `DATABASE_URL` | **Internal Database URL** из карточки вашей PostgreSQL на Render (формат `postgres://user:pass@host/dbname`) |
| `LOG_CHANNEL` | stack |
| `LOG_LEVEL` | warning |
| `CACHE_DRIVER` | file |
| `SESSION_DRIVER` | file |
| `QUEUE_CONNECTION` | sync |
| `MAIL_MAILER` | smtp |
| `MAIL_HOST` | smtp.gmail.com |
| `MAIL_PORT` | 587 |
| `MAIL_USERNAME` | designcraftreset@gmail.com |
| `MAIL_PASSWORD` | пароль приложения Gmail |
| `MAIL_ENCRYPTION` | tls |
| `MAIL_FROM_ADDRESS` | designcraftreset@gmail.com |
| `MAIL_FROM_NAME` | DesignCraft |

`DATABASE_URL` и `DB_CONNECTION=pgsql` обязательны — без них приложение не подключится к базе на Render.

---

## 2. База PostgreSQL на Render

1. [dashboard.render.com](https://dashboard.render.com) → **New → PostgreSQL** (если базы ещё нет).
2. Имя: например `designcraft-db`, регион — тот же, что у Web Service.
3. Тариф: **Free** (или платный).
4. **Create Database**.
5. В карточке базы:
   - **Internal Database URL** — скопируйте и вставьте в переменную `DATABASE_URL` в Environment Web Service (шаг 1).
   - **External Database URL** — понадобится для импорта данных с вашего ПК (шаг 5).
6. Если будете импортировать с ПК: откройте **Databases** в меню Render → ваша база **PostgreSQL** (не Web Service). В карточке базы в **Info** или **Settings** найдите **Allow connections from** / **Trusted Sources** и добавьте ваш IP: `ВАШ_IP/32` (например `50.7.88.138/32`). Узнать IP: [ifconfig.me](https://ifconfig.me).

---

## 3. Репозиторий и деплой

1. Закоммитьте и запушьте код в GitHub (если ещё не сделано):
   ```bash
   git add .
   git commit -m "Deploy to Render"
   git push origin main
   ```
2. В Render: **New → Web Service** (или откройте существующий `srv-d6fm2q95pdvs73djbl90`).
3. Подключите репозиторий с DesignCraft.
4. Настройки сервиса:
   - **Runtime:** Docker.
   - **Branch:** main.
   - **Build Command** и **Start Command** — пусто (используется Dockerfile).
5. В **Environment** добавьте все переменные из шага 1, включая `DATABASE_URL` из PostgreSQL.
6. **Create Web Service** (или **Save**). Дождитесь сборки и запуска (5–10 минут при первом деплое).
7. После деплоя откройте https://designcraft-xej3.onrender.com и в Environment укажите `APP_URL=https://designcraft-xej3.onrender.com`.

---

## 4. Как обновить сайт на Render (поменять код на боевом)

После любых изменений в коде (вёрстка, логика, миграции и т.д.) нужно заново задеплоить сервис — тогда сайт на Render подхватит изменения.

### Вариант А: Автодеплой с GitHub (рекомендуется)

1. В папке проекта закоммитьте и запушьте изменения:
   ```bash
   cd c:\ospanel\domains\DesignCraft
   git add .
   git commit -m "Описание изменений"
   git push origin main
   ```
2. Если к Render подключён репозиторий и включён **Auto-Deploy**, через 1–2 минуты начнётся сборка. Статус смотрите в [Dashboard](https://dashboard.render.com) → ваш Web Service → **Logs**.
3. После успешного деплоя сайт обновится по адресу **https://designcraft-xej3.onrender.com**.

### Вариант Б: Ручной деплой

1. Откройте [Dashboard Render](https://dashboard.render.com) → Web Service **DesignCraft**.
2. Вкладка **Manual Deploy** → **Deploy latest commit** (или выберите ветку/коммит).
3. Дождитесь окончания сборки и запуска — сайт обновится.

### Если добавляли миграции

Новые миграции Laravel выполняются при каждом деплое автоматически (скрипт в `docker/render-start.sh` запускает `php artisan migrate --force`). Отдельно что-то делать не нужно.

### Деплой по Deploy Hook (без git push)

В Render: **Settings** → **Build & Deploy** → **Deploy Hook**. Скопируйте секретный URL и вызывайте его (GET или POST), когда нужно запустить деплой без push в GitHub (например, из скрипта или CI). URL храните в секрете.

### Кратко

| Действие | Результат |
|----------|-----------|
| `git push origin main` | При включённом Auto-Deploy сайт на Render обновится сам |
| Manual Deploy в панели Render | То же, без push (деплой последнего коммита ветки `main`) |
| Запрос по Deploy Hook URL | Запуск деплоя без push |

---

## 5. Перенос текущей базы данных на Render

Чтобы залить **текущую локальную базу** (OSPanel/MySQL) в PostgreSQL на Render:

### 5.1. Экспорт с локального сайта

В корне проекта (где лежит `artisan`) выполните:

```bash
php artisan db:export
```

Появится папка **`storage/app/db-export`** с JSON-файлами по таблицам (users, applications и т.д.).

### 5.2. Подключение к базе Render с вашего ПК

1. В [dashboard.render.com](https://dashboard.render.com) откройте вашу PostgreSQL.
2. Скопируйте **External Database URL** (для подключения с ПК), например:
   ```
   postgresql://designcraft_db_user:ПАРОЛЬ@dpg-xxxx.frankfurt-postgres.render.com/designcraft_db?sslmode=require
   ```
3. В **локальном** `.env` временно пропишите (для импорта):
   ```env
   DB_CONNECTION=pgsql
   DATABASE_URL=postgresql://designcraft_db_user:ПАРОЛЬ@dpg-xxxx.frankfurt-postgres.render.com/designcraft_db?sslmode=require
   ```
   Подставьте свой URL и пароль из Render. Остальные строки БД (DB_HOST, DB_PORT и т.д.) можно закомментировать или оставить — при наличии `DATABASE_URL` Laravel использует его.

### 5.3. Импорт в PostgreSQL на Render

В папке проекта выполните:

```bash
php artisan db:import --force
```

`--force` очищает целевые таблицы перед вставкой, чтобы не было дубликатов.

### 5.4. После импорта

- Верните в `.env` настройки для локальной MySQL/OSPanel, если продолжаете разрабатывать локально.
- Откройте сайт на Render — пользователи, заказы и остальные данные из текущей БД должны отображаться.

**Важно:** переносятся только данные в БД. Файлы (аватарки, превью) на Render не копируются; загруженные на Render файлы на бесплатном тарифе живут только до перезапуска контейнера.

### 5.5. Импорт БД изнутри Render (вариант B — если с ПК «server closed the connection»)

Если `php artisan db:import --force` с вашего ПК к Render PostgreSQL обрывается, импорт можно выполнить **на стороне Render** (подключение к базе будет внутренним).

1. **Локально** создайте экспорт:
   ```bash
   php artisan db:export
   ```
   Или, если есть только SQL-дамп MySQL:
   ```bash
   php artisan db:import-from-sql "путь/к/файлу.sql"
   ```
   В обоих случаях появятся JSON в `storage/app/db-export`.

2. **Скопируйте** содержимое папки `storage/app/db-export` в папку **`database/db-export`** в проекте (эта папка в репозитории). То есть в репозитории должны быть файлы вида `database/db-export/users.json`, `database/db-export/applications.json` и т.д.

3. Закоммитьте и запушьте:
   ```bash
   git add database/db-export/
   git commit -m "Add db export for Render import"
   git push origin main
   ```

4. В **Environment** Web Service на Render добавьте переменную:
   - Key: `IMPORT_DB_TOKEN`
   - Value: любой секретный набор символов (например `importSecret456`).

5. После деплоя откройте в браузере **один раз**:
   ```
   https://designcraft-xej3.onrender.com/import-db?token=importSecret456
   ```
   (подставьте свой токен и свой домен). Импорт выполнится; в ответе будет список импортированных таблиц.

6. После успешного импорта:
   - Удалите переменную `IMPORT_DB_TOKEN` из Environment (безопасность).
   - По желанию удалите маршрут `/import-db` из `routes/web.php` и при следующих деплоях можно убрать папку `database/db-export` из репозитория (или оставить пустой).

---

## 6. После первого запуска

1. В Environment Web Service укажите `APP_URL=https://designcraft-xej3.onrender.com`.
2. **Создать админа на Free (без Shell):** в Environment добавьте переменную `SETUP_ADMIN_TOKEN` = любой секретный набор символов (например `mySecret123`). Задеплойте, затем откройте в браузере: `https://designcraft-xej3.onrender.com/setup-admin?token=mySecret123` (подставьте свой токен). Админ создастся (логин: ii5543135@gmail.com, пароль: ii5543135@gmail.com). После этого удалите `SETUP_ADMIN_TOKEN` из Environment и при желании маршрут `/setup-admin` из кода.

---

## Кратко

| Что | Где / как |
|-----|-----------|
| Переменные для хоста | [Environment Web Service](https://dashboard.render.com/web/srv-d6fm2q95pdvs73djbl90/env) |
| Локальный .env | Для OSPanel; на Render не используется |
| База на Render | PostgreSQL; `DATABASE_URL` из карточки базы |
| **Обновить сайт** | `cd c:\ospanel\domains\DesignCraft` → `git add .` → `git commit -m "Описание изменений"` → `git push origin main` (при включённом Auto-Deploy сайт обновится сам) или Manual Deploy в панели Render |
| Текущая БД → Render | С ПК: `db:export` → в .env временно `DATABASE_URL` (External) → `db:import --force`. Либо вариант B: JSON в `database/db-export`, деплой, затем `/import-db?token=IMPORT_DB_TOKEN` один раз. |

- Бесплатный инстанс «засыпает» после ~15 минут без запросов; первый запрос после простоя может идти 30–60 секунд.
- Письма: Gmail SMTP, пароль приложения в `MAIL_PASSWORD`.
- Файлы пользователей на бесплатном плане не сохраняются между перезапусками; для постоянного хранения нужен Render Disk или S3.

После выполнения шагов сайт с текущей базой будет доступен по ссылке Render.
