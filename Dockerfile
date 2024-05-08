# Use an official PHP image as base
FROM php:8.2-fpm

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy code to /var/www
COPY --chown=www:www-data . /var/www/html

# add root to www group
RUN chmod 777 -R /var/www/html/storage

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install zip pdo_mysql pdo_sqlite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the application files
COPY . /var/www/html

RUN cd /var/www/html

# Copy .env.example to .env
RUN cp .env.example .env

# Install Laravel dependencies
RUN composer update -vvv --optimize-autoloader

# Generate application key
RUN php artisan key:generate

# Run database migrations
RUN php artisan migrate --seed

# Change ownership of the application files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm
