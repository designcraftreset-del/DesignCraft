#!/usr/bin/env bash
set -e
cd /var/www/html

# Render ожидает приложение на порту PORT (по умолчанию 10000)
export PORT="${PORT:-10000}"
echo "Using port $PORT for nginx"
for f in /etc/nginx/sites-enabled/default /etc/nginx/conf.d/default.conf /etc/nginx/nginx.conf /etc/nginx/sites-available/default; do
  if [ -f "$f" ] && grep -q "listen 80" "$f"; then
    sed -i "s/listen 80;/listen $PORT;/g" "$f"
    sed -i "s/listen \[::\]:80/listen [::]:$PORT/g" "$f"
    # Laravel: передавать все запросы в index.php (иначе /login, /register и т.д. дают 404)
    sed -i 's|try_files \$uri \$uri/ =404;|try_files $uri $uri/ /index.php?$query_string;|' "$f"
    # Корень сайта — public (Laravel)
    sed -i "s|root /var/www/html;|root /var/www/html/public;|g" "$f"
    echo "Patched $f (port $PORT, Laravel front controller)" && break
  fi
done

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
