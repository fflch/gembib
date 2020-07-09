# Sobre o projeto

Sistema que gerencia o fluxo de aquisição e processameto de livros
desde a sugestão até a catalogação.

Instruções para a instalação do projeto:

    composer install
	  cp .env.example .env
	  php artisan key:generate
	  php artisan vendor:publish --provider="Uspdev\UspTheme\ServiceProvider" --tag=assets --force
      php artisan migrate
	  php artisan serve
	

Workflow: 
	sudo apt-get install graphviz
    php artisan workflow:dump -v workflow_itens --class=App\\Item

![workflow](https://raw.githubusercontent.com/fflch/gembib/master/workflow_itens.png)



