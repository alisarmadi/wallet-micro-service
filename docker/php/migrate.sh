#!/usr/bin/env bash

service cron restart
composer install --ignore-platform-reqs
composer dump-autoload
php artisan db:create
php artisan migrate --force

php-fpm

exec "$@"
