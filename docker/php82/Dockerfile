FROM php:8.2-fpm-alpine

# see: https://stackoverflow.com/a/57650040
# https://qiita.com/ucan-lab/items/fbf021bf69896538e515
RUN apk upgrade --update
RUN apk --no-cache add \
    autoconf \
    build-base \
    git \
    linux-headers

RUN pecl install xdebug redis \
    && docker-php-ext-enable xdebug redis

RUN docker-php-ext-install \
    pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY php.development.ini /usr/local/etc/php/php.ini
COPY 99-xdebug.ini /usr/local/etc/php/conf.d/