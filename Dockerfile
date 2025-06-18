# Composer image for back-end dependencies
FROM composer AS composer-build

WORKDIR /var/www/html

COPY composer.json composer.lock /var/www/html/

RUN mkdir -p /var/www/html/database/{factories,seeds} \
    && composer install --no-dev --prefer-dist --no-scripts --no-autoloader --no-progress --ignore-platform-reqs

# NPM image for front-end dependencies
FROM node:20 AS npm-build

WORKDIR /var/www/html

COPY package.json package-lock.json webpack.mix.js tailwind.config.js /var/www/html/
COPY resources /var/www/html/resources/
COPY public /var/www/html/public/

RUN npm ci
RUN npm run production

# PHP image that will host Laravel
FROM php:8.3-apache

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update \
    && apt-get install --quiet --yes --no-install-recommends libzip-dev unzip libmemcached-dev \
    && docker-php-ext-install bcmath ctype pdo_mysql zip

# Enable caching
RUN a2enmod expires headers

# Configure Virtual Hosts
COPY docker/laravel.conf /etc/apache2/sites-available/laravel.conf
RUN a2enmod rewrite \
    && a2dissite 000-default.conf \
    && a2ensite laravel.conf \
    && service apache2 restart

# Copy over composer & npm dependencies
COPY --chown=www-data . /var/www/html
COPY --chown=www-data --from=composer-build /var/www/html/vendor/ /var/www/html/vendor/
COPY --chown=www-data --from=npm-build /var/www/html/public/ /var/www/html/public/

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer dump -o && composer check-platform-reqs

# Expose web port
EXPOSE 80