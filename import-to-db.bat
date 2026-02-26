@echo off
chcp 65001 >nul
cd /d "%~dp0"
if not exist artisan (echo Запустите этот файл из папки проекта DesignCraft. & pause & exit /b 1)
echo Importing JSON from storage/app/db-export to current DB...
php artisan db:import --force
echo.
pause
