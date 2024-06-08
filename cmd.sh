#!/bin/sh

php artisan migrate --force -n

# rr serve -c ./.rr.yaml
/usr/bin/php -d variables_order=EGPCS /var/www/html/artisan octane:start --server=roadrunner --host=0.0.0.0 --rpc-port=6001 --port=8080
