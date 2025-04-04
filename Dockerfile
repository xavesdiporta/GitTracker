# Usa imagem base com PHP e Apache
FROM php:7.4-apache

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    libonig-dev \
    libpng-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da app
COPY . /var/www/html

# Corrige o DocumentRoot para apontar para /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Corrige permissões (essencial para Laravel)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala dependências Laravel e configura app
RUN cp .env.example .env \
    && composer install --no-dev --optimize-autoloader \
    && php artisan key:generate \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Expondo porta 80 (Apache)
EXPOSE 80

# Comando para iniciar Apache + executar migrations
CMD php artisan migrate --force && apache2-foreground
