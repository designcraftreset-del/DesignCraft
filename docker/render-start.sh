#!/usr/bin/env bash
set -e
cd /var/www/html

echo "Running composer..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders (if any)..."
php artisan db:seed --force 2>/dev/null || true

echo "Linking storage..."
php artisan storage:link 2>/dev/null || true

echo "Starting nginx and php-fpm..."
exec /start.sh
