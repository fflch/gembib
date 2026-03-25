Criando imagem:

    docker build --no-cache -t gembib .


docker compose up

docker compose exec -u root gembib bash
composer install
chown -R www-data:www-data storage bootstrap/cache




docker compose down -v

docker compose exec mariadb bash

mariadb -ugembib -pgembib

docker compose exec mariadb mariadb -u gembib -pgembib


docker compose exec gembib bash


docker compose exec -u root gembib bash