# Sobre o projeto

Sistema que gerencia o fluxo de aquisição e processamento de livros
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


## Atualizações no banco

16/nov/2021

	UPDATE itens SET tipo_aquisicao='Doação' WHERE tipo_aquisicao='Retombamento';
	UPDATE itens SET prioridade='0' WHERE prioridade='Coleção Didática';
	UPDATE itens SET prioridade=NULL WHERE prioridade='';




