# Use the official PHP image
FROM php:7.4-apache

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy the application files
COPY . .

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
