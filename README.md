# Plataforma de Pagamentos - Pago Ya!

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

PagoYa! e uma plataforma pensada como uma solucao para oferecer practicidade e comforto na hora de realizar trasnsacoes financieiras.

Se voce for uma pessoa fisica, e inclusive uma pessoa juridica, pode criar a sua conta na PagoYa! sem problemas, e muito rapido.

Cada usuario que se cadastra na plataforma possui uma carteira com um saldo inicial definido por o mesmo, e apartir dela consegue realizar envio de dinheiro para outros usuarios.

Importante destacar que aqueles usuarios que sejam pessoas juridicas so podem receber dinheiro nas suas carteirias.
Atualmente o envio de dinheiro esta limitado aos usuarios pessoa fisica.

## Tecnologias Utilizadas

O projeto de PagoYa! foi criado utilizando as seguintes ferramentas: 

- [Framework PHP Lumen](https://lumen.laravel.com)

Foi escolhido por temas de practicidade (contem muitas funcionalidades e ferramentas ideais para o projeto) e tambem pela sua estrutura de organizacao.

- [Composer](https://getcomposer.org)

Composer permite fazer uma otima gestao de pacotes que sao necessarios para solventar todas as dependencias do projeto.

- [JWT](https://jwt.io)

O JWT e um estandar aberto (RFC 7519) que define uma forma compacta e auto-contida para transmitir informacao entre diferentes entes, sendo esta assinada digitalmente.

## Requerimentos

- PHP >= 7.3
- MySQL >= 8
- Composer >= 2.1.3

## Instalacao e Setup

Apos baixar o projeto e verificar as versoes corretas de PHP e composer na sua maquina, execute o seguinte comando dentro da pasta raiz do projeto:

```bash
composer install
```

Depois, faca uma copia do arquivo .env.example localizado na raiz do projeto e atualize o nome do novo arquivo para .env

Pode fazer isso executando o seguinte comando dentro da pasta raiz do projeto:

```bash
cp .env.example .env
```

O seguinte passo e configurar a chave APP_KEY dentro do arquivo .env. Uma das formas de realizar isso e simplesmente executando o seguinte comando no seu terminal, copiar o retorno e colocar no APP_KEY dentro do arquivo .env

```bash
php -r "echo md5(uniqid()).\"\n\";"
```

Nao esqueca de configurar o banco de dados nas variaveis correspondentes

```bash
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Apos configurar as credenciais do banco de dados, execute o seguinte comando para criar automaticamente as tabelas que a plataforma precisa

```
php artisan migrate
```

Para finalizar, so resta gerar o JWT secret, necessario para o funcionamento da livraria

```bash
php artisan jwt:secret
```

## Deploy local

Para executar o projeto na sua maquina, basta executar o seguinte comando na pasta raiz do projeto

```
php -S localhost:8000 -t public
```

## Endpoints disponiveis

A API de PagoYa! oferece 4 endpoints para as operacoes mais elementais:

- SignUp
- Login
- Logout
- Transaction

A continuacao, serao detalhada cada uma de elas, a fim de explicar como funcionam:

### SignUp

`POST /api/signup`

Endpoint utilizado para criar um novo usuario dentro da plataforma. 

Observacoes:

O parametro "document" pode ser um CPF ou CNPJ devidamente formatado

Nao pode se cadastrar dois usuarios que utilizem o mesmo documento ou o mesmo email

O parametro balance precisa de ter um valor minimo de 0.01

    curl -i -H 'Content-Type: application/json'
    --request POST 'http://localhost:8000/api/signup'
    --data-raw '{
        "full_name": "User name",
        "document": "123.456.789-01",
        "email": "user@example.com",
        "password": "12345",
        "phone": "27999123456",
        "balance": 12.34
    }'

#### Response - 201 Created

    HTTP/1.1 201 Created
    Status: 201 Created
    Content-Type: application/json

    {
        "data": [],
        "message": "User was created successfully",
        "errors": [],
        "timestamp": "2021-07-25 19:21:20" 
    }

#### Response - 400 Document already taken

    HTTP/1.1 400 Bad Request
    Status: 400 Bad Request
    Content-Type: application/json

    {
        "data": [],
        "message": "Invalid request body",
        "errors": {
            "document": "The document has already been taken."
        },
        "timestamp": "2021-07-25 21:10:34"
    }

#### Response - 400 Email already taken

    HTTP/1.1 400 Bad Request
    Status: 400 Bad Request
    Content-Type: application/json

    {
        "data": [],
        "message": "Invalid request body",
        "errors": {
            "email": "The email has already been taken."
        },
        "timestamp": "2021-07-25 21:13:01"
    }

### Login

`POST /api/login`

Endpoint utilizado para autenticar um usuario dentro da plataforma.

Atraves do endpoint e possivel obter um Bearer Token que e necessario para realizar as transacoes dentro da plataforma. 

Tal Bearer Token precisa ir no cabecalho das proximas requisicoes, que precisam de autenticacao.

Observacoes:

O login e realizado utilizando o email do usuario e a senha cadastrada no endpoint de signup

    curl -i -H 'Content-Type: application/json'
    --request POST 'http://localhost:8000/api/login'
    --data-raw '{
        "email": "userexample@gmail.com",
        "password": "12345"
    }'

#### Response - 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    {
        "data": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyNzIzODIzNSwiZXhwIjoxNjI3MjQxODM1LCJuYmYiOjE2MjcyMzgyMzUsImp0aSI6ImtZWDFHZktGRjZaR3B0RGkiLCJzdWIiOjcsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.BNmYRn8rf1isff2TcnCz1ZTJ20YsnH3qE8ALns01wEA",
            "token_type": "Bearer",
            "expires_in": null
        },
        "message": "Login successful",
        "errors": [],
        "timestamp": "2021-07-25 18:37:15"
    }

#### Response - 401 (Email/senha incorretos)

    HTTP/1.1 401 Unauthorized
    Status: 401 Unauthorized
    Content-Type: application/json

    {
        "data": [],
        "message": "Please, verify your access credentials",
        "errors": [],
        "timestamp": "2021-07-25 21:25:41"
    }

#### Response - 400 (Email nao cadastrado)

    HTTP/1.1 400 Bad Request
    Status: 400 Bad Request
    Content-Type: application/json

    {
        "data": [],
        "message": "Invalid request body",
        "errors": {
            "email": "The selected email is invalid."
        },
        "timestamp": "2021-07-25 21:20:05"
    }

#### Response - 400 (Password nao presente na requisicao)

    HTTP/1.1 400 Bad Request
    Status: 400 Bad Request
    Content-Type: application/json

    {
        "data": [],
        "message": "Invalid request body",
        "errors": {
            "password": "The password field is required."
        },
        "timestamp": "2021-07-25 21:21:16"
    }

### Create Transaction

`POST /api/transaction`

Endpoint utilizado para realizar uma transacao entre as carteirinhas de 2 usuarios.

Observacoes:

E necessario enviar o Bearer Token obtido no login para conseguir realizar a transacao.

O Bearer Token precisa ser do usuario que esta especificado no campo "payer", caso contrario nao podera realizar a operacao.

    curl -i -H 'Content-Type: application/json'
    --request POST 'http://localhost:8000/api/transaction'
    --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc'
    --data-raw '{
        "value" : 1,
        "payer" : 7,
        "payee" : 8
    }'

#### Response - 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    {
        "data": [],
        "message": "Operacao realizada com sucesso",
        "errors": [],
        "timestamp": "2021-07-25 18:37:15"
    }

#### Response - 200 OK (Nao foi possivel enviar a notificacao)

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    {
        "data": [],
        "message": "Operacao realizada com sucesso",
        "errors": {
            "notificationService": "Nao foi possivel enviar a notificacao"
        ,
        "timestamp": "2021-07-25 18:37:15"
    }

#### Response - 401 Unauthorized (Usuario nao tem permissao)

    HTTP/1.1 401 Unauthorized
    Status: 401 Unauthorized
    Content-Type: application/json

    {
        "data": [],
        "message": "",
        "errors": "User does not have priviledges to perform this operation",
        "timestamp": "2021-07-25 21:56:04"
    }

### Logout

`POST /api/logout`

Endpoint utilizado para realizar logout do usuario dentro da plataforma.

Observacoes:

E necessario enviar o Bearer Token obtido no login para conseguir realizar a operacao.

    curl -i -H 'Content-Type: application/json'
    --request POST 'http://localhost:8000/api/logout'
    --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc'
    --data-raw ''

#### Response - 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    {
        "data": [],
        "message": "Logout successful",
        "errors": [],
        "timestamp": "2021-07-25 18:37:58"
    }

## Testes

Os testes estao divididos em Unitarios e Integracao.

Cada um deles possui a sua propria testsuite descrita no arquivo phpunit.xml

Para executar os testes unitarios, utilize o seguinte comando na pasta raiz do projeto:

```
./vendor/bin/phpunit --testsuite unit_testing   
```
