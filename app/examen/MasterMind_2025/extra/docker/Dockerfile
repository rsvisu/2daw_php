FROM php:8.4-apache
ENV DEBIAN_FRONTEND=noninteractive
RUN apt update
#Para composer necesito estas librerías
RUN apt -y install vim \
    zip unzip git vim libzip-dev libicu-dev

RUN echo "<Directory /var/www/html>" >> /etc/apache2/apache2.conf
RUN echo "Options +Indexes"  >> /etc/apache2/apache2.conf
RUN echo "</Directory>"  >> /etc/apache2/apache2.conf

 # Instalar Xdebug
 RUN pecl install xdebug \
     && docker-php-ext-enable xdebug


#RUN echo "xdebug.mode=off" > /usr/local/etc/php/conf.d/xdebug.ini
#RUN echo "xdebug.start_with_request=no" >> /usr/local/etc/php/conf.d/xdebug.ini
#RUN echo "xdebug.discover_client_host=true" >> /usr/local/etc/php/conf.d/xdebug.ini
#RUN echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/xdebug.ini


#RUN echo "ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/apache2.conf
#RUN mkdir -p /var/log/apache2 && touch /var/log/apache2/error.log


RUN docker-php-ext-install  \
    mysqli \
    zip \
    intl
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-install opcache
COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini


# Dentro del Dockerfile
# RUN echo "xdebug.mode=off" >> /usr/local/etc/php/conf.d/xdebug.ini
# echo "xdebug.mode=debug" > /usr/local/etc/php/conf.d/xdebug.ini
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
EXPOSE 80
