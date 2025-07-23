FROM php:8.1-apache

# Ativa o mod_rewrite (útil para rotas amigáveis)
RUN a2enmod rewrite

# Copia todo o projeto para dentro do container
COPY . /var/www/html/

# Altera o DocumentRoot do Apache para apontar para a pasta /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Dá permissão para leitura
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta 80
EXPOSE 80
