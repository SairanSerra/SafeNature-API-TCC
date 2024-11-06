FROM php:7.4-fpm

# Install necessary dependencies for Playwright and Laravel
RUN apt-get update && apt-get install -y \
    libonig-dev \
    postgresql-server-dev-all \
    libxml2-dev \
    libpng-dev \
    git \
    curl \
    bash \
    ca-certificates \
    libffi-dev \
    libx11-dev \
    libxkbfile-dev \
    libatk1.0-dev \
    libxcomposite-dev \
    libxrandr-dev \
    libgdk-pixbuf2.0-dev \
    libpango1.0-dev \
    libgtk-3-dev \
    dbus-x11 \
    libnss3-dev \
    libcups2-dev \
    libxss-dev \
    dbus-x11

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Verify Node.js version
RUN node -v

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
WORKDIR /app/safeNatureApi

# Copy application files
COPY . .

# Set Composer environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_VENDOR_DIR="/app/safeNatureApi/vendor"

# Install Composer dependencies
RUN composer install --ignore-platform-reqs

# Install Playwright and download browsers
RUN npm install -g playwright \
    && npx playwright install --with-deps

# Cache Laravel configuration
CMD ["sh"]
