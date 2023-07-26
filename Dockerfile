FROM php:8.2-fpm

RUN apt-get update \
    && apt-get install -y libzip-dev \
    && apt-get install -y git \
    && apt-get install -y zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/php-api-client
COPY . /var/www/php-api-client
