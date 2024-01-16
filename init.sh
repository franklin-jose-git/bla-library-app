#!/bin/sh

cd /var/www/html
cp .env.docker .env
php artisan key:generate
php artisan jwt:secret --force
php artisan migrate --seed