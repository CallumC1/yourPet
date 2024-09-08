# Use an official PHP image as the base image
FROM php:8.2-apache

# Install Node.js (LTS version), npm, and git
RUN apt-get update && apt-get install -y curl git \
    && curl -sL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install mysqli

# Set the working directory
WORKDIR /var/www/html

# Copy the virtual host configuration
COPY ./apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy the application files to the container
COPY ./app /var/www/html/app
COPY package.json /var/www/html/package.json
# COPY router.php /var/www/html/router.php # Moved into app folder.
COPY tailwind.config.js /var/www/html/
COPY ./public /var/www/html/public

# Copy PHP ini configuration
COPY ./php.ini /usr/local/etc/php/php.ini

# Install Node.js dependencies
RUN npm install
#RUN npm run build:css
RUN npm run watch:css

# Setup Composer
COPY composer.json /var/www/html/composer.json
RUN composer install
RUN composer require resend/resend-php

# Reload Autoloader
RUN composer dump-autoload





# Expose port 80
EXPOSE 80
