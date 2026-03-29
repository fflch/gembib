Criando imagem:

    docker build --no-cache -t gembib .

Ambiente dev:

    cp .env.example .env
    docker compose up
    docker compose exec -u root gembib bash
    git config --global --add safe.directory /var/www/html
    composer install
    chown -R www-data:www-data /var/www/html/storage/logs
    php artisan key:generate





docker compose down -v

docker compose exec mariadb bash

mariadb -ugembib -pgembib

docker compose exec mariadb mariadb -u gembib -pgembib


docker compose exec gembib bash


docker compose exec -u root gembib bash