# Imagem base do PHP com Apache
FROM php:8.1-apache

# Instala extensões PHP necessárias para Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Ativa mod_rewrite
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto Laravel
COPY . .

# Ajusta o DocumentRoot para apontar para /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permissões para storage e cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instala o Composer (diretamente da imagem oficial)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Expõe a porta padrão
EXPOSE 80

# Comando final: prepara ambiente e inicia o Apache
CMD ["sh", "-c", "cp .env.example .env && php artisan key:generate && apache2-foreground"]
