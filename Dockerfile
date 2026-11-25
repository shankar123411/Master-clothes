FROM php:8.2-cli

# Install system dependencies & PHP extensions required by Laravel 12, Filament 5, SQLite & DomPDF
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libsqlite3-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_sqlite intl zip mbstring xml gd bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP dependencies first for better layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader

# Copy application source
COPY . .

# Finalize autoloader & publish Filament CSS/JS/Font assets
RUN composer dump-autoload --optimize \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache database \
    && php artisan filament:assets \
    && sed -i 's/\r$//' render-start.sh \
    && chmod +x render-start.sh

EXPOSE 10000

CMD ["./render-start.sh"]
