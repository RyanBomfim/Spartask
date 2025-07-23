FROM php:8.1-apache

# Ativa mod_rewrite (caso use URLs amigáveis)
RUN a2enmod rewrite

# Copia todos os arquivos pro servidor
COPY . /var/www/html/

# Define permissões (opcional)
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta usada pelo Apache
EXPOSE 80
