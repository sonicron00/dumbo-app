# Use PHP 7.3
FROM php:7.3-fpm-buster

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# PHP extensions
RUN apt-get update && apt-get install -y libpq-dev libpng-dev git zip unzip libzip-dev \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install pdo pdo_mysql bcmath pdo_pgsql gd zip

# Composer
RUN apt-get install -y curl
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Kafka
RUN apt-get install -y librdkafka-dev
RUN pecl install rdkafka-3.1.2 && docker-php-ext-enable rdkafka

# Xdebug install
RUN pecl install xdebug-2.7.1
RUN docker-php-ext-enable xdebug

# Xdebug Args
ARG XDEBUG_REMOTE_ENABLE=0
ARG XDEBUG_REMOTE_AUTOSTART=0
ARG XDEBUG_PROFILER_ENABLE=0

# Add Xdebug vars to php.ini
RUN if [ "${XDEBUG_REMOTE_ENABLE}" != "" ] ; then echo "xdebug.remote_enable=${XDEBUG_REMOTE_ENABLE}" >> $PHP_INI_DIR/php.ini; fi
RUN if [ "${XDEBUG_REMOTE_AUTOSTART}" != "" ] ; then echo "xdebug.remote_autostart=${XDEBUG_REMOTE_AUTOSTART}" >> $PHP_INI_DIR/php.ini; fi
RUN if [ "${XDEBUG_PROFILER_ENABLE}" != "" ] ; then echo "xdebug.profiler_enable=${XDEBUG_PROFILER_ENABLE}" >> $PHP_INI_DIR/php.ini; fi
RUN if [ "${XDEBUG_REMOTE_ENABLE}" != "" ] ; then echo "xdebug.profiler_output_dir='storage/profiling'" >> $PHP_INI_DIR/php.ini; fi