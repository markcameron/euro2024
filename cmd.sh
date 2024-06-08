#!/bin/sh

php artisan migrate --force -n

# rr serve -c ./.rr.yaml
php -d variables_order=EGPCS artisan octane:start --server=roadrunner --host=0.0.0.0 --rpc-port=6001 --port=8080
