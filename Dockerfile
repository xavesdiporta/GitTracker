# Use uma imagem oficial PHP com Apache
FROM php:7.4-apache

# Define o diretório de trabalho no container
WORKDIR /var/www/html

# Instala dependências do sistema necessárias e o Composer
RUN apt-get update -y && \
       apt-get install -y --no-install-recommends \
       libzip-dev unzip && \
       docker-php-ext-install mysqli && \
       # Baixar e instalar o Composer
       curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

   # Copia os arquivos restantes do projeto
COPY . /var/www/html

   # Expõe a porta 5000, caso necessário
EXPOSE 5000

   # Comando padrão ao iniciar o container
CMD ["php", "-S", "0.0.0.0:5000", "-t", "public"]
