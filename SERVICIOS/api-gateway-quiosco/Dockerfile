# Usar una imagen base de PHP con Apache
FROM php:8.2-apache

# Configurar el entorno de trabajo
WORKDIR /var/www/html

# Instalar Composer y las extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev && \
    docker-php-ext-install pdo pdo_mysql zip

# Copiar los archivos de tu aplicación al contenedor
COPY . /var/www/html

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Instalar dependencias con Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-dev --optimize-autoloader

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Exponer el puerto 80
EXPOSE 80

# Iniciar el servidor Apache
CMD ["apache2-foreground"]
