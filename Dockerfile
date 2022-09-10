# dockerfile
FROM php:8.1-fpm

#USER root

# Copy composer.lock and composer.json
COPY composer.lock* composer.json* /var/www/

# Set working directory
WORKDIR /var/www

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install dependencies
RUN apt-get update && apt-get install -y \
    bzr \
    cvs \
    git \
    mercurial \
    subversion \
    zip \
    unzip \
    libpq-dev \
    vim \
    nano \
    libjpeg62-turbo-dev \
    libpng-dev

RUN rm -rf /tmp/pear

# # Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# RUN docker-php-ext-install telescope
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-configure gd --with-freetype-dir=/usr --with-jpeg-dir=/usr --with-png-dir=/usr
RUN docker-php-ext-configure gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

RUN composer install --no-scripts
# Copy existing application directory permissions
COPY --chown=www:www . /var/www
RUN chmod -R 777 /var/www
RUN chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
