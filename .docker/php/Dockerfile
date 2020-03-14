FROM php:fpm-alpine

WORKDIR /app/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./ /app/

RUN composer install
