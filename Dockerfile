FROM php:7.4-fpm-alpine

# Install Laravel framework system requirements
RUN apk add --no-cache \
        oniguruma-dev \
        postgresql-dev \
        libxml2-dev \
        libpng-dev # Add libpng-dev for GD extension

# Install GD extension
RUN docker-php-ext-install gd

# Install other PHP extensions required by Laravel
RUN docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        json \
        mbstring \
        pdo_mysql \
        pdo_pgsql \
        tokenizer \
        xml

# Install Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Set working directory
WORKDIR /app/ignicao-digital

# Copy application files
COPY . .

# Set Composer environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_VENDOR_DIR="/app/ignicao-digital/vendor"

# Install Composer dependencies
RUN composer install --ignore-platform-reqs

# Cache Laravel configuration
RUN php artisan config:cache

# Cache Laravel routes
RUN php artisan route:cache

# Cache Laravel views
RUN php artisan view:cache

# Clear configuration cache
RUN php artisan config:clear

# Start Laravel application
CMD php artisan serve --host=0.0.0.0 --port=8000
