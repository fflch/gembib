Criando imagem:

    docker build --no-cache -t gembib .

docker compose up -d --build


docker compose down -v

docker compose exec mariadb bash

mariadb -ugembib -pgembib

docker compose exec mariadb mariadb -u gembib -pgembib


docker compose exec gembib bash


docker compose exec -u root gembib bash