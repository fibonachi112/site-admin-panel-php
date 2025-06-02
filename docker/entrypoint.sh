#!/bin/bash

# Запускаем PHP-FPM в фоне
php-fpm -D
nginx -g 'daemon off;'