#!/bin/bash
# Start PHP-FPM in background
php-fpm -F &
# Start Apache in foreground
exec /usr/sbin/httpd -D FOREGROUND