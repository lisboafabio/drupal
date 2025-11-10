## Sistema simples de votação
Projeto feito em drupal para criação de um sistema simples de votação criado com a versão 10.x drupal.

## Instalação
Para iniciar o projeto, você precisa ter o [lando](https://docs.lando.dev/getting-started/) instalado na sua máquina.<br>
Caso Possua o gerenciador de container instalado rode <kbd>lando start</kbd> para iniciar a aplicação, <kdb>lando composer install</kdb>, depois <kbd>lando db-import ./database/dump.sql</kbd> para importar os dados da aplicação e após popular o banco, rodar <kbd>lando drush cr</kbd>.
Após a instância dos containers necessários, voce pode acessar o [my-drupal10](https://my-drupal10.lndo.site/admin) utilizando para login e senha <b>admin</b>

## Documentação
Para acessar o sistema de votação, basta clicar no item <b>Sistema de Votação</b> na aba <b>Manage</b> do sistema administrativo.<br>
Lá possui todas as opções para gerenciar o sistema de votação.

## Informações uteis
Para os usuários que não são admin, ao realizar o login, na aba de <b>Shortcuts</b> há o link de acesso para votar.

## Api
A api possui uma collection para ser importada no postam que está no diretorio <kdb>./postman</kdb> simples que contém as informações dos endpoints e pode ser importada no postman.