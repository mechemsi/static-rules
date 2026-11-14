FROM php:8.5-cli@sha256:50956f094e90a716d43bea28087d447555ad80510e386ab8c9c10d8c70d781a9

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions that might be needed for static analysis tools
RUN docker-php-ext-install \
    pcntl \
    && docker-php-ext-enable pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
# Set working directory
WORKDIR /var/www/html

# Install dependencies when container starts
RUN composer --version
