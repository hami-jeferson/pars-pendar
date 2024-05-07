# Use an official PHP image as base
FROM php:8.2-fpm

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

# Install Laravel
#RUN composer global require laravel/installer

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
