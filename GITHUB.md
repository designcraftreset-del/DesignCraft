# Как залить проект на GitHub

Репозиторий уже инициализирован и первый коммит создан. Осталось создать репозиторий на GitHub и отправить код.

---

## Шаг 1. Создать репозиторий на GitHub

1. Зайдите на [github.com](https://github.com) и войдите в аккаунт.
2. Нажмите **+** → **New repository**.
3. **Repository name:** например `DesignCraft`.
4. Оставьте **Public**, не добавляйте README, .gitignore и лицензию (всё уже есть в проекте).
5. Нажмите **Create repository**.

---

## Шаг 2. Привязать удалённый репозиторий и отправить код

В папке проекта выполните в терминале (подставьте **свой логин** и **имя репозитория**):

```bash
cd c:\ospanel\domains\DesignCraft

git remote add origin https://github.com/ВАШ_ЛОГИН/DesignCraft.git
git push -u origin main
```

Пример: если ваш логин `ivan123`, то:

```bash
git remote add origin https://github.com/ivan123/DesignCraft.git
git push -u origin main
```

При первом `git push` браузер или Git запросят вход в GitHub (логин и пароль или **Personal Access Token**).  
Если используете двухфакторную аутентификацию, нужен токен: GitHub → Settings → Developer settings → Personal access tokens → Generate new token (с правом `repo`).

---

После успешного `git push` код будет на GitHub, и репозиторий можно будет подключить к Render по инструкции в **RENDER.md**.
