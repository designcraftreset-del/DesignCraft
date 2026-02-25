# Деплой DesignCraft на Render.com

Проект подготовлен к деплою на Render: добавлены Dockerfile, скрипт запуска и принудительный HTTPS для production. База на Render — **PostgreSQL** (бесплатный тариф).

---

## Что нужно сделать (по шагам)

### 1. Репозиторий на GitHub

Если проекта ещё нет в GitHub:

1. Зарегистрируйтесь на [github.com](https://github.com).
2. Создайте новый репозиторий (например, `DesignCraft`).
3. В корне проекта выполните (подставьте свой репозиторий):

```bash
git init
git add .
git commit -m "Prepare for Render deploy"
git branch -M main
git remote add origin https://github.com/ВАШ_ЛОГИН/DesignCraft.git
git push -u origin main
```

Файл **`.env`** в репозиторий не попадает (он в `.gitignore`) — переменные окружения вы зададите в Render.

---

### 2. База PostgreSQL на Render

1. Зайдите на [dashboard.render.com](https://dashboard.render.com).
2. **New → PostgreSQL**.
3. Имя: например `designcraft-db`, регион выберите ближайший.
4. Тариф: **Free** (если устраивают ограничения).
5. Нажмите **Create Database**.
6. В карточке базы откройте **Info** и скопируйте **Internal Database URL** (формат `postgres://user:pass@host/dbname`). Он понадобится в шаге 4.

---

### 3. Web Service (сайт) на Render

1. В Dashboard: **New → Web Service**.
2. Подключите GitHub и выберите репозиторий с DesignCraft (если нет — настройте доступ в GitHub Settings).
3. Настройки:
   - **Name:** `designcraft` (или любое).
   - **Region:** тот же, что у базы.
   - **Runtime:** **Docker**.
   - **Branch:** `main`.
4. Поле **Build Command** оставьте пустым (сборка идёт через Dockerfile).
5. **Start Command** оставьте пустым (используется `CMD` из Dockerfile).

---

### 4. Переменные окружения (Environment)

В разделе **Environment** Web Service добавьте переменные (кнопка **Add Environment Variable**):

| Key | Value |
|-----|--------|
| `APP_NAME` | DesignCraft |
| `APP_ENV` | production |
| `APP_DEBUG` | false |
| `APP_KEY` | Сгенерируйте локально: `php artisan key:generate --show` и вставьте сюда |
| `APP_URL` | https://ваш-сервис.onrender.com (после первого деплоя замените на точный URL из Render) |
| `DB_CONNECTION` | pgsql |
| `DATABASE_URL` | Вставьте **Internal Database URL** из шага 2 (из карточки PostgreSQL) |
| `MAIL_MAILER` | smtp |
| `MAIL_HOST` | smtp.gmail.com |
| `MAIL_PORT` | 587 |
| `MAIL_USERNAME` | designcraftreset@gmail.com |
| `MAIL_PASSWORD` | ваш пароль приложения Gmail |
| `MAIL_ENCRYPTION` | tls |
| `MAIL_FROM_ADDRESS` | designcraftreset@gmail.com |
| `MAIL_FROM_NAME` | DesignCraft |

`DATABASE_URL` и `DB_CONNECTION=pgsql` обязательны — без них миграции не подключатся к базе.

---

### 5. Создать Web Service и дождаться деплоя

1. Нажмите **Create Web Service**.
2. Render соберёт образ по Dockerfile и запустит контейнер. Первый деплой может занять 5–10 минут.
3. В логах должны появиться строки: composer, config:cache, route:cache, migrate, затем запуск nginx/php-fpm.
4. После успешного деплоя откройте ссылку вида **https://designcraft-xxxx.onrender.com** — должен открыться сайт.

---

### 6. После первого запуска

1. В настройках Web Service замените **APP_URL** на точный URL вашего сервиса (например, `https://designcraft-xxxx.onrender.com`).
2. При необходимости создайте первого админа через `php artisan tinker` (на Render это делается через **Shell** в карточке сервиса) или через миграцию/сидер, если он у вас есть.

---

## Важно

- **Бесплатный инстанс** на Render «засыпает» после ~15 минут без запросов. Первый запрос после простоя может выполняться 30–60 секунд.
- База **PostgreSQL**: проект изначально на MySQL, но Laravel и миграции совместимы с PostgreSQL. Если какая-то миграция упадёт (например, из-за `enum`), её нужно будет поправить под PostgreSQL.
- Письма отправляются через Gmail (SMTP) — пароль приложения укажите в `MAIL_PASSWORD`.
- Файлы, загружаемые пользователями (аватарки, превью), на бесплатном инстансе хранятся в контейнере и могут теряться при перезапуске. Для постоянного хранения нужен внешний диск (Render Disks) или S3-совместимое хранилище.

После выполнения шагов сайт будет доступен по ссылке Render любому пользователю в интернете.
