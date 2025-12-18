FROM php:8.4-apache

RUN echo "<Directory /var/www/html>" >> /etc/apache2/sites-enabled/000-default.conf
RUN echo "Options +Indexes" >> /etc/apache2/sites-enabled/000-default.conf
RUN echo "</Directory>" >> /etc/apache2/sites-enabled/000-default.conf

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install mysqli

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

EXPOSE 80