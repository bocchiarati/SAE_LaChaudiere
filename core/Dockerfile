# Dockerfile
FROM php:8.2-alpine

# Install extensions and dependencies (mysqli for MySQL)
RUN apk add --no-cache \
    bash \
    curl \
    icu-libs \
    libxml2 \
    oniguruma \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/src

# Copy code (this will be overridden by volumes in docker-compose)
COPY public /var/www/html
COPY src /var/www/src

# Expose port 80
EXPOSE 80

# Run PHP's built-in server
CMD sh -c "composer install && php -S 0.0.0.0:80 -t /var/www/html"
