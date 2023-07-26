FROM php:8.2-fpm-bullseye

WORKDIR /var/www/html

# copy php.ini
COPY ./docker/back/php/php.ini /usr/local/etc/php/php.ini

# install composer v2.2 LTS
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# update apt-get, install need package
RUN apt-get update \
    && apt-get -y install \
    git \
    zip \
    unzip \
    vim \
    libpng-dev \
    libicu-dev \
    && docker-php-ext-install pdo_mysql bcmath intl
