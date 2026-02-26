# Запуск сайта через OSPanel

## 1. Корневая папка сайта (Document Root)

Laravel должен открываться из папки **`public`**. Настройте домен в OSPanel так:

- **Вариант А (рекомендуется):** в настройках домена укажите корень сайта = папка **`public`**:
  - Путь: `c:\ospanel\domains\DesignCraft\public`
  - Тогда URL будет без `/public` в адресе (например, `http://designcraft`).

- **Вариант Б:** если корень домена указывает на `DesignCraft` (без `\public`), добавьте в корень проекта файл **`.htaccess`** (см. ниже) — он перенаправит запросы в `public`.

## 2. URL сайта

Обычно в OSPanel папка `domains\DesignCraft` доступна по адресу:
- **http://designcraft** или **http://designcraft.loc**

В файле **`.env`** должна совпадать переменная:
```env
APP_URL=http://designcraft
```
(или `http://designcraft.loc` — как у вас открывается сайт в браузере.)

## 3. База данных для локальной работы

В **`.env`** для OSPanel выставьте MySQL:
```env
DB_CONNECTION=mysql
# DATABASE_URL=...   ← закомментируйте или удалите строку DATABASE_URL
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xkgdykj-m1
DB_USERNAME=root
DB_PASSWORD=
```

## 4. Быстрый запуск

1. Запустите **OSPanel** (Apache/Nginx + MySQL).
2. Откройте в браузере: **http://designcraft** (или ваш URL).
3. Либо дважды нажмите **`open-site.bat`** в папке проекта — откроется этот адрес.

## 5. Корень сайта = папка DesignCraft (без public)

В корне проекта уже есть **`.htaccess`**, который перенаправляет все запросы в папку `public`. Если в OSPanel домен указывает на `c:\ospanel\domains\DesignCraft`, сайт откроется по адресу **http://designcraft** (или **http://designcraft.loc** — в зависимости от настроек OSPanel). В **`.env`** оставьте `APP_URL=http://designcraft` (или ваш реальный URL).

## 6. Секция «До и После» — не отображаются фото

Фото лежат в папке **`public/image/before-after/`** (файлы `before.jpg` и `after.jpg`). Секция выводится на странице **/index** (после входа).

Если блок «До и После» показывается, но картинки пустые:

1. **Откройте сайт по тому же адресу, что в браузере**  
   Например, если заходите по `http://designcraft` — в OSPanel у домена должен быть корень `...\DesignCraft\public` (вариант А выше) или корень `...\DesignCraft` с корневым `.htaccess` (вариант Б).

2. **Проверьте доступ к файлу по прямой ссылке**  
   В браузере откройте: `http://ВАШ_ДОМЕН/image/before-after/before.jpg`  
   (подставьте ваш URL, например `http://designcraft`). Должна открыться картинка. Если 404 — запросы не доходят до папки `public/image/`, проверьте корень сайта в OSPanel.

3. **Очистка кэша Laravel**  
   В папке проекта выполните: `php artisan config:clear`
