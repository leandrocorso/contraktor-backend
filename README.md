# contraktor-backend

A lumen Rest API for Contraktor test

# Requisitos

Esta API foi desenvolvida usando o PHP 7.2, MySQL 5.7 e lumen 5.3 e Composer.

# Instalação

Clone o repositório com o comando: git clone "https://github.com/leandrocorso/contraktor-backend.git"

Aba a pasta do projeto pelo terminal e com o Composer instalado digite "php composer install"

Depois, como o MySql instalado digite "php artisan migrate".

O projeto pode rodar diretamente do servidor local do php pelo comando "php -S http://localhost:5000 -t public"

# Endpoints

Contratos:

GET /api/contracts = Retorna todos os contratos registrados
GET /api/contracts/(id) = Retorna o contrato com o id específico
POST /api/contracts = Envia os dados do contrato no body
PUT /api/contracts = Atualiza o registro cujo id está no body
DELETE /api/contracts/(id) = Exclui o registro do contrato com o id específico

Partes

GET /api/parts = Retorna todas sa partes registradas
GET /api/parts/(id) = Retorna a parte com o id específico
POST /api/parts = Envia os dados da parte no body
PUT /api/parts = Atualiza o registro da parte cujo id está no body
DELETE /api/parts/(id) = Exclui o registro da parte com o id específico
