FROM php:8.4-apache

# 1. Actualizamos e instalamos dependencias para Postgres y MySQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql

# 2. Usamos la configuración de desarrollo de PHP (habilita errores por defecto)
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# 3. (Opcional) Forzar valores específicos si quieres ser más estricto
RUN echo "display_errors = On" >> $PHP_INI_DIR/conf.d/error-logging.ini && \
    echo "display_startup_errors = On" >> $PHP_INI_DIR/conf.d/error-logging.ini && \
    echo "error_reporting = E_ALL" >> $PHP_INI_DIR/conf.d/error-logging.ini

# 4. Habilitamos mod_rewrite de Apache (muy útil para aplicaciones PHP)
RUN a2enmod rewrite
