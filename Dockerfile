FROM php:7.4-apache

RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

COPY src/app /var/www/html/
COPY src/static /var/www/html/static/

RUN chown -R www-data:www-data /var/www/html/uploads
