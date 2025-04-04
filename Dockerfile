FROM php:7.4-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    libonig-dev \
    libpng-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Ativa mod_rewrite para Laravel
RUN a2enmod rewrite

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da app Laravel
COPY . .

# Corrige DocumentRoot para /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Corrige permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Agora sim: instala dependências
RUN composer install --no-dev --optimize-autoloader

# Expondo porta 80
EXPOSE 80

# Comando ao iniciar container
CMD ["sh", "-c", "cp .env.example .env && php artisan key:generate && php artisan migrate --force && apache2-foreground"]
