# Use uma imagem oficial do PHP 8.3 com Apache
FROM php:8.3-apache

# Configure o diretório de trabalho no container
WORKDIR /var/www/html

# Instala dependências necessárias do sistema e extensões do PHP
RUN apt-get update -y && apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
        gd \
        intl \
        mbstring \
        exif \
        bcmath \
        zip \
        pcntl && \
    docker-php-ext-enable \
        exif \
        intl \
        bcmath \
        zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copie os arquivos do projeto para o container
COPY . /var/www/html

# Instala as dependências do Laravel com Composer
RUN composer install --no-dev --optimize-autoloader

# Ajusta permissões para diretórios necessários
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data /var/www/html

# Expõe a porta 5000 (caso seja necessário)
EXPOSE 5000

# Define o comando padrão ao iniciar o container
CMD ["php", "-S", "0.0.0.0:5000", "-t", "public"]
