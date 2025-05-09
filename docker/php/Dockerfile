FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    git \
    && docker-php-ext-install \
    pdo_mysql \
    intl \
    zip \
    opcache \
    xml \
    mbstring \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/laravel

CMD ["php-fpm"]

EXPOSE 9000
