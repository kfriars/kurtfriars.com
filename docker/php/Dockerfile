FROM php:7.4-fpm

# doesn't matter for mysql & mysqldum console tools for local usage
ENV MYSQL_PWD root

RUN apt-get update \
    && apt-get install -y libpq-dev libgmp-dev libpng-dev libxml2-dev git zip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
        gd \
        opcache \
        json \
        pdo_mysql \
        soap \
        xml \
        bcmath \
        pcntl

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN pecl install -o -f redis \
        &&  rm -rf /tmp/pear \
        &&  docker-php-ext-enable redis

WORKDIR /tmp
RUN apt-get update \
    && apt-get install -y pkg-config libmagickwand-dev wget \
    && wget https://pecl.php.net/get/imagick-3.4.3.tgz \
    && tar xvzf imagick-3.4.3.tgz \
    && cd imagick-3.4.3 \
    && phpize \
    && ./configure \
    && make install \
    && rm -rf /tmp/imagick-3.4.3* \
    && echo extension=imagick.so >> /usr/local/etc/php/php.ini

WORKDIR /app

RUN curl --silent --show-error https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer && \
    composer clear-cache

COPY docker/php/config/www.conf /usr/local/etc/php-fpm.d/www.conf
CMD ["php-fpm", "--allow-to-run-as-root"]

COPY . /app/

ARG COMPOSER_AUTH
ADD composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-suggest && \
    composer clear-cache

RUN composer dump --optimize
