# Как залить базу из файла .sql на Render

Ваш дамп: **xkgdykj-m1 (1).sql** (из папки Загрузки).

---

## Шаг 1. Скопировать дамп в проект (удобно для путей)

Скопируйте файл в папку проекта, чтобы в путях не было пробелов и скобок:

```
Скопируйте:
  c:\Users\Иван\Downloads\xkgdykj-m1 (1).sql

Вставьте в:
  c:\ospanel\domains\DesignCraft\storage\app\xkgdykj-m1.sql
```

Или оставьте файл в Загрузках — тогда в командах ниже используйте полный путь в кавычках.

---

## Шаг 2. Взять URL базы с Render

База задаётся **не** на странице [Environment Web Service](https://dashboard.render.com/web/srv-d6fm2q95pdvs73djbl90/env), а в карточке **PostgreSQL**:

1. Откройте [dashboard.render.com](https://dashboard.render.com) → раздел **Databases**.
2. Выберите вашу базу (например **designcraft-db**).
3. В блоке **Connect** скопируйте **External Database URL** (для подключения с вашего ПК).  
   Формат:  
   `postgresql://USER:PASSWORD@dpg-xxxxx.region.postgres.render.com/DATABASE?sslmode=require`

Если базы ещё нет — создайте: **New → PostgreSQL**, затем скопируйте этот же URL.

**Разрешить подключение с вашего ПК:** это настраивается в **базе PostgreSQL**, а не в Web Service (сайт). В боковом меню Render нажмите **Databases** (или откройте дашборд и выберите вашу базу **designcraft-db** / PostgreSQL). В карточке **базы данных** откройте **Info** или **Settings** и найдите **Allow connections from** или **Trusted Sources**. Добавьте ваш IP в формате CIDR, например `50.7.88.138/32`. Узнать свой IP: [ifconfig.me](https://ifconfig.me). Без этого импорт с ПК может обрываться (server closed the connection).

---

## Шаг 3. Прописать в .env подключение к Render

В файле **`c:\ospanel\domains\DesignCraft\.env`**:

1. Оставьте или установите:
   ```env
   DB_CONNECTION=pgsql
   ```
2. Вставьте скопированный URL в одну строку (без переносов):
   ```env
   DATABASE_URL=postgresql://USER:PASSWORD@dpg-xxxxx.region.postgres.render.com/DATABASE?sslmode=require
   ```

Сохраните `.env`. Остальные строки БД (DB_HOST, DB_PORT и т.д.) можно не менять — при наличии `DATABASE_URL` Laravel использует его.

---

## Шаг 4. Разобрать дамп MySQL в JSON

В **PowerShell** или **cmd** в папке проекта выполните (подставьте свой путь к .sql):

**Если файл уже в проекте** (`storage\app\xkgdykj-m1.sql`):

```powershell
cd c:\ospanel\domains\DesignCraft
php artisan db:import-from-sql storage\app\xkgdykj-m1.sql
```

**Если файл в Загрузках** (путь в кавычках из-за пробелов и скобок):

```powershell
cd c:\ospanel\domains\DesignCraft
php artisan db:import-from-sql "c:\Users\Иван\Downloads\xkgdykj-m1 (1).sql"
```

Команда создаст папку **`storage\app\db-export`** с JSON-файлами по таблицам.

---

## Шаг 5. Импорт в PostgreSQL на Render

Не меняя `.env` (в нём уже `DATABASE_URL` на Render), выполните:

```powershell
cd c:\ospanel\domains\DesignCraft
php artisan db:import --force
```

`--force` очищает таблицы на Render перед вставкой. После выполнения данные из дампа окажутся в базе на Render.

---

## Шаг 6. Проверка

1. В [Environment](https://dashboard.render.com/web/srv-d6fm2q95pdvs73djbl90/env) вашего Web Service должна быть переменная **DATABASE_URL** с тем же **Internal Database URL** (из карточки PostgreSQL → Internal).
2. Откройте сайт на Render (URL из сервиса) — пользователи и заказы из старой базы должны отображаться.

---

## Вариант: импорт изнутри Render по URL (если с ПК обрывается)

На тарифе **Free** вкладка **Shell** недоступна. Импорт выполняется по одноразовой ссылке **/import-db**.

1. Локально: `php artisan db:export` (или `db:import-from-sql "путь\к\файлу.sql"`) — появятся JSON в `storage\app\db-export`.
2. Скопируйте все файлы из `storage\app\db-export` в папку **`database\db-export`** в проекте.
3. Закоммитьте и запушьте: `git add database/db-export/` → `git commit -m "Add db export"` → `git push origin main`.
4. В **Environment** Web Service добавьте: `IMPORT_DB_TOKEN` = любой секрет (например `importSecret456`).
5. После деплоя откройте в браузере **один раз**: `https://ваш-сайт.onrender.com/import-db?token=importSecret456`.
6. После успешного импорта удалите `IMPORT_DB_TOKEN` из Environment.

**Полная инструкция со всеми шагами и переменными:** см. файл **RENDER-FULL-GUIDE.md** в корне проекта.

---

## Если что-то пошло не так

- **«File not found»** — проверьте путь к .sql (кавычки, пробелы, скобки в имени).
- **Ошибка подключения к БД** — проверьте `DATABASE_URL` в `.env`, что пароль не обрезан и в Render в базе разрешён ваш IP (Allow connections from).
- **Ошибка при импорте** — убедитесь, что перед `db:import --force` вы выполнили `db:import-from-sql` и в `storage\app\db-export` есть .json файлы.

После импорта можно вернуть в `.env` локальное подключение к MySQL (закомментировать `DATABASE_URL`, выставить `DB_CONNECTION=mysql` и т.д.), если снова работаете локально.
