# Use uma imagem do PHP com extensões necessárias para Laravel
FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala Node.js e npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Define o diretório de trabalho
WORKDIR /var/www

# Copia o arquivo de configuração php.ini (opcional)
COPY ./php.ini /usr/local/etc/php/

# Instala dependências do Laravel
COPY . .
RUN composer install --optimize-autoloader --no-dev

# Instala dependências do Node.js
RUN npm install
RUN npm run build

# Define permissões de pastas de armazenamento
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expõe a porta do servidor PHP
EXPOSE 9000

CMD ["php-fpm"]
