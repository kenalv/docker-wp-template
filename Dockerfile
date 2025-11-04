# WordPress + Apache + PHP 8.3
FROM wordpress:6.8.2-php8.3-apache

# Install Redis extension now (optional but recommended for later)
RUN pecl install redis && docker-php-ext-enable redis

# Useful tools (curl, unzip)
RUN apt-get update && apt-get install -y --no-install-recommends \
    curl unzip ca-certificates openssl \
  && rm -rf /var/lib/apt/lists/*

# PHP & Apache tuning
COPY ./config/php.ini /usr/local/etc/php/conf.d/zz-custom.ini
COPY ./config/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./config/apache.conf /etc/apache2/conf-available/custom.conf
RUN a2enconf custom && a2enmod rewrite headers expires

# WordPress config & content
COPY ./config/wp-config.php /var/www/html/wp-config.php
COPY ./wp-content /var/www/html/wp-content

# Permissions (kept minimal; final pass in init script)
RUN chown -R www-data:www-data /var/www/html

# Healthcheck is optional
HEALTHCHECK CMD curl -fsS http://localhost/wp-login.php || exit 1