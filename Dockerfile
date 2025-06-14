# Use the PHP 8.4 Alpine base image
FROM php:8.4-rc-fpm-alpine

# Install system packages
RUN apk add --no-cache \
    bash \
    shadow \
    curl \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    freetype-dev \
    zip \
    unzip \
    libxml2-dev \
    oniguruma-dev \
    icu-dev \
    libzip-dev \
    g++ \
    make \
    autoconf \
    nginx \
    openssl \
    tzdata \
    postgresql-dev

# Configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        mbstring \
        zip \
        intl \
        bcmath \
        opcache \
        gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy app source (if building an image with app bundled)
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose laravel port
EXPOSE 8000

# Start PHP-FPM
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
