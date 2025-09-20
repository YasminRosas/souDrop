# souDrop
O projeto já está quase pronto! Falta apenas uma pequena etapa para que a tela de produtos seja exibida corretamente, na nova atualização será arrumado

Instruções de Instalação e Execução
Este guia irá detalhar o ambiente necessário e os comandos para rodar o projeto.

Pré-requisitos
Para rodar este projeto, você precisa ter as seguintes ferramentas instaladas na sua máquina:

PHP 8.0+: A linguagem de programação do back-end.
Composer: Gerenciador de dependências do PHP.
Node.js e NPM: Para a instalação das dependências de front-end.
Banco de Dados MySQL: O banco de dados para armazenar os dados.

Servidor Local (XAMPP, Laragon ou similar): Ferramentas que empacotam PHP, MySQL e um servidor web, facilitando a configuração.

Passo a Passo da Instalação
Clone o Repositório:
Abra o terminal e clone o projeto para a sua máquina.

git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
Instale as Dependências do PHP:
O Composer irá baixar todas as bibliotecas PHP necessárias para o Laravel.

composer install
Configurar o Arquivo .env:
Copie o arquivo de exemplo e configure o projeto.

cp .env.example .env
Em seguida, abra o novo arquivo .env e configure as credenciais do seu banco de dados:

Snippet de código

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco # Crie este banco no seu phpMyAdmin
DB_USERNAME=root # Usuário padrão do XAMPP
DB_PASSWORD=
Gerar a Chave da Aplicação:
Esta chave é crucial para a segurança do projeto.


php artisan key:generate
Rodar as Migrações do Banco de Dados:
Este comando irá criar as tabelas users e products no seu banco de dados.


php artisan migrate
Iniciar o Servidor de Desenvolvimento:
Rode este comando para iniciar o servidor local do Laravel.

php artisan serve
Acesso ao Projeto
Após seguir os passos, acesse o projeto no seu navegador:

URL Principal: http://127.0.0.1:8000

Cadastro: http://127.0.0.1:8000/register

Login: http://127.0.0.1:8000/login

Padrões Laravel Utilizados
Este projeto foi construído seguindo as melhores práticas do Laravel, o que garante organização e escalabilidade.

MVC (Model-View-Controller)
Este é o principal padrão de arquitetura do projeto.

Model: Representa a lógica de dados e a interação com o banco. O modelo User e o modelo Product são os responsáveis por essa camada.
View: É a camada de apresentação, ou seja, as telas HTML (.blade.php). As views do projeto (login.blade.php, index.blade.php, etc.) exibem os dados e recebem a interação do usuário.
Controller: Conecta o Model e a View, gerenciando a lógica das requisições. Os controladores AuthController e ProductController processam os dados, interagem com o banco e retornam a view correta.
