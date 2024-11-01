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

# Estrutura do Projeto

O projeto contém os seguintes diretórios principais:

-   app/: Código-fonte do Laravel.
-   public/: Diretório público para os ativos (CSS, JavaScript, imagens).
-   resources/: Recursos como views, arquivos de tradução e estilos.
-   docker/: Contém arquivos de configuração do Docker.
-   nginx/: Configurações do servidor Nginx.

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

3 - Acesse o Contêiner do Aplicativo

```bash
docker-compose exec app bash
```

4 - Execute a Migração e o Seed do Banco de Dados

```bash
php artisan migrate --seed
```

5 - Crie um Link Simbólico para o Storage do Laravel

```bash
php artisan storage:link
```

6 - Mova o arquivo chat-llm-439820-79477fff5a23 para storage/app

7 - Acesse a Aplicação

```bash
http://localhost
```
