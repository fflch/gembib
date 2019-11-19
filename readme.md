# Sobre o projeto

Sistema que gerencia o fluxo de aquisição e processameto de livros
desde a sugestão até a catalogação.

Status:
 
 - Sugestão
   - Negado (motivo)
   - Em processo de aquisição
     - Adquirir: outras campos e o tipo (doação ou compra)
     - Em tombamento
     - Enviado para STL
     - Entrada no STL e Processamento Técnico
     - Processado

Ações/Campos:

 - Sugestão: Autor, Título, Editora, Ano
 - Processar Sugestão(-> Em processo de aquisição): motivo e mudança de status (Em processo de aquisição ou negado)
 - Processar Aquisição(-> em tombamento): (Adquirido por Doação/Compra) outros campos

Instruções para a instalação do projeto:
é necessário a instalação do composer para prosseguir

    composer install
	cp .env.example .env
	php artisan key:generate
	php artisan vendor:publish --provider="Uspdev\UspTheme\ServiceProvider" --tag=assets --force
  php artisan migrate
	php artisan serve
	

Instruções para mandar uma mudança:

1)Adicionar as mudanças: git add .
2)Comitar as mudanças: git commit -m "Resolvendo issue1"
3)Enviar branch para o Fork: git push origin master
4)No github, criar um pull request


Criar user e banco de dados:

	grant all privileges on gembib.* to gembib@'%' identified by 'gembib';
