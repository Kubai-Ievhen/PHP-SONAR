#!/bin/sh

[ -f ./.env ] || cp ./.env.local ./.env

php artisan config:clear;
php artisan config:cache;
php composer.phar install;

chmod -R 777 /application/bootstrap/cache;
chmod -R 777 /application/storage;

set -e
while ! (timeout 3 bash -c "</dev/tcp/${DB_HOST}/${DB_PORT}")
do
	echo -e "waiting for mysql, to start...";
	sleep 3;
done;

# uncomment the line below on first installation
#php artisan migrate:install
php artisan migrate --force;

service cron start;
service supervisor start;


php-fpm;

