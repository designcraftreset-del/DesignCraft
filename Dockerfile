# Render.com: Laravel + Nginx + PHP-FPM
FROM richarvey/nginx-php-fpm:3.1.6

COPY . /var/www/html
WORKDIR /var/www/html

ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV COMPOSER_ALLOW_SUPERUSER 1

# Production defaults (override with Render env vars)
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Run deploy steps then start nginx/php-fpm
COPY docker/render-start.sh /render-start.sh
RUN chmod +x /render-start.sh
CMD ["/render-start.sh"]
