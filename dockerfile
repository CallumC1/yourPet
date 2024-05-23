# Use an official PHP image as the base image
FROM php:7.4-apache

# Install Node.js (LTS version) and npm
RUN apt-get update && apt-get install -y curl \
    && curl -sL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs


# Install MySQLi extension
RUN docker-php-ext-install mysqli


# Copy the application files to the container
# COPY . /var/www/html


COPY ./app /var/www/html/app
COPY ./public /var/www/html/public
COPY package.json /var/www/html/
COPY router.php /var/www/html/
COPY tailwind.config.js /var/www/html/




# Copy the virtual host configuration
COPY ./apache/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN npm install
RUN npm run build:css


# Enable Apache mod_rewrite (optional, if you need it)
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80