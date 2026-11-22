FROM php:8.6-cli@sha256:d84acf3155d907afaa5afa9b9457c5f12016b6dc7ade84659f40cdc505cc087d

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    curl \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP 8.6's CLI image no longer bundles mbstring.
RUN docker-php-ext-install \
    mbstring \
    pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
# Set working directory
WORKDIR /var/www/html

# Install dependencies when container starts
RUN composer --version
