# STAGE 1
FROM composer AS source

WORKDIR /home/build

COPY . .

RUN composer install

# FINAL STAGE
FROM php:7.2-apache

RUN a2enmod rewrite && \
    a2enmod headers

COPY --from=source /home/build/ /var/www/html
