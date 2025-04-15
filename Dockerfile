# Usa imagem oficial do PHP 8.3 com Apache
FROM php:8.3-apache

# Define diretório de trabalho
WORKDIR /var/www/html

# Instala dependências do sistema e extensões do PHP
RUN apt-get update -y && apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libpq-dev \
    curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        intl \
        mbstring \
        exif \
        bcmath \
        zip \
        pcntl \
        pdo \
        pdo_pgsql \
    && docker-php-ext-enable \
        exif \
        intl \
        bcmath \
        zip \
        pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Copia todos os arquivos do projeto para dentro do container
COPY . /var/www/html

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Instala dependências do Node.js e builda o Vite
RUN npm install && npm run build

# Ajusta permissões
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data /var/www/html

# Expõe a porta 5000
EXPOSE 5000

# Define o comando default
CMD ["php", "-S", "0.0.0.0:5000", "-t", "public"]
