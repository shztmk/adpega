FROM php:8.2-fpm-alpine

# see: https://stackoverflow.com/a/57650040
# https://qiita.com/ucan-lab/items/fbf021bf69896538e515
RUN apk update \
    && apk add git autoconf build-base linux-headers

# https://stackoverflow.com/a/50088033
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode = develop,coverage,debug,gcstats,profile,trace" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey=phpstorm" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable xdebug

WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
RUN mkdir -p vendor/bin
ENV PATH /var/www/vendor/bin:${PATH}