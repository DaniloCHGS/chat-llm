# Etapa 1: Define a imagem base do PHP com todas as extensões necessárias para o Laravel
FROM php:8.2-fpm

# Instala dependências e ferramentas do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia os arquivos do projeto para o container
WORKDIR /var/www
COPY . .

# Instala dependências do Laravel
RUN composer install

# Define as permissões do diretório de cache e logs
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Expõe a porta do servidor Laravel
EXPOSE 9000
