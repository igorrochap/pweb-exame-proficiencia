#!/bin/sh
set -e

if [ ! -d ./vendor ]; then
    composer install
    cp .env.docker .env
    php artisan key:generate
    php artisan jwt:key
    php artisan migrate --seed --force
fi

php artisan serve --host=0.0.0.0 --port=8000
