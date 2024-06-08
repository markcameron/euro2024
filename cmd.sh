#!/bin/sh

php artisan migrate --force -n

php artisan optimize

/usr/local/bin/docker-php-entrypoint --config /etc/caddy/Caddyfile --adapter caddyfile
