# Usamos la imagen oficial de PHP con Apache
FROM php:8.4-apache

# Instalamos extensiones
RUN docker-php-ext-install mysqli

# Habilitamos el módulo rewrite por si se usa .htaccess
RUN a2enmod rewrite

# COPIAMOS los archivos al contenedor
COPY /app/ /var/www/html/

# Ajustamos permisos para que Apache pueda leer/escribir
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Configuramos Apache para permitir el listado de directorios
RUN echo "<Directory /var/www/html>" >> /etc/apache2/sites-enabled/000-default.conf
RUN echo "Options +Indexes" >> /etc/apache2/sites-enabled/000-default.conf
RUN echo "</Directory>" >> /etc/apache2/sites-enabled/000-default.conf