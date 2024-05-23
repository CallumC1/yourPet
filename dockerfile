# Use an official PHP image as the base image
FROM php:7.4-apache

# Install Node.js (LTS version), npm, and git
RUN apt-get update && apt-get install -y curl git \
    && curl -sL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install mysqli

# Set the working directory
WORKDIR /var/www/html

# Copy the virtual host configuration
COPY ./apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache mod_rewrite (optional, if you need it)
RUN a2enmod rewrite

# Copy the application files to the container
COPY ./app /var/www/html/app
COPY package.json /var/www/html/package.json
COPY router.php /var/www/html/router.php
COPY tailwind.config.js /var/www/html/
COPY ./public /var/www/html/public

# Install Node.js dependencies
RUN npm install


# Expose port 80
EXPOSE 80

