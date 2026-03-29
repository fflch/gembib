#! /bin/bash

# Comandos laravel
php artisan key:generate
php artisan optimize:clear

# Para desenvolvimento, é necessário dar permissão de escrita para o usuário www-data
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Necessário para php:8.3-apache
exec apache2-foreground
