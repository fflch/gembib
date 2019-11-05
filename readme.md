Instruções para a instalação do projeto:
é necessário a instalação do composer para prosseguir

    composer install
	cp .env.example .env
	php artisan key:generate
	php artisan serve

Instruções para mandar uma mudança:

1)Criar ou adotar uma issue
2)Criar uma branch: git checkout -b issue1
3)Adicionar as mudanças: git add .
4)Comitar as mudanças: git commit -m "Resolvendo issue1"
5)Enviar branch para o Fork: git push origin issue1
6)Voltar para branch master
7)No github, criar um pull request
8)Depois quue o pull request for aceito, atualizar fork

    git remote update
	git merge upstream/master
