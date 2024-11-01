# Chat LLM

Chat LLM é uma aplicação Laravel 11 que utiliza Tailwind CSS no front-end e MySQL como banco de dados. Este projeto foi desenvolvido para fornecer uma interface de chat com Inteligencia Artificial e utiliza Docker para facilitar a configuração e do ambiente de desenvolvimento.

## Pré-requisitos

Antes de começar, certifique-se de que você tem os seguintes softwares instalados:

-   [Docker](https://www.docker.com/get-started)
-   [Docker Compose](https://docs.docker.com/compose/install/)

## Clonando o Repositório

Clone o repositório em sua máquina local:

```bash
git clone git@github.com:DaniloCHGS/chat-llm.git
cd chat-llm
```

# Configurando o Projeto com Docker

1 - Crie um arquivo .env (Copie o .env.example)

Atualize as configurações do banco de dados e as API KEYS. Vou enviar por privado as API KEYS de GROQ_API_KEY e GOOGLE_VISION_KEY

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel

GROQ_API_KEY
GOOGLE_VISION_KEY
```

2 - Construa os Contêineres Docker

Execute o comando abaixo para construir os contêineres:

```bash
docker-compose up -d --build
```

3 - Instale as Dependências do Laravel

```bash
docker-compose exec app composer install
```

4 - Gere a Chave de Aplicação

```bash
docker-compose exec app php artisan key:generate
```

5 - Execute as Migrações e o Seed do Banco de Dados

```bash
docker-compose exec app php artisan migrate --seed
```

6 - Crie um Link Simbólico para o Storage do Laravel

```bash
docker-compose exec app php artisan storage:link
```

7 - Mova a chave chat-llm.json (que foir enviada) para storage/app

8 - Instale as Dependências do Node

```bash
docker-compose exec app npm install
```

9 - Gere um build do Front-end

```bash
docker-compose exec app npm run build
```

10 - Acesse a Aplicação

```bash
http://localhost
```
