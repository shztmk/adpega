FROM php:8.2-fpm-alpine

# see: https://stackoverflow.com/a/57650040
# https://qiita.com/ucan-lab/items/fbf021bf69896538e515
RUN apk upgrade --update
RUN apk --no-cache add \
    autoconf \
    build-base \
    git \
    libzip-dev \
    linux-headers

RUN docker-php-ext-install \
    pdo_mysql \
    zip

RUN pecl install \
    redis \
    xdebug

RUN docker-php-ext-enable \
    redis \
    sodium \
    xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY php.development.ini /usr/local/etc/php/php.ini