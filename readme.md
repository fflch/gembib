Criando imagem:

    docker build --no-cache -t gembib .

Ambiente dev:

    docker compose up

Comandos do laravel dentro do container:

    cp .env.example .env
    docker exec -u root -it gembib composer install
    docker exec -u root -it gembib php artisan key:generate
    docker exec -u root -it gembib php artisan migrate

Acessando os containers via ssh:

    docker compose exec -u root gembib bash
    docker compose exec -u root mariadb bash

