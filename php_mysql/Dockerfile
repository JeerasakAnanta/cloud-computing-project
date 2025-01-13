# Use the official PHP image as the base image
FROM php:8.0-apache

# Install necessary PHP extensions and other dependencies
RUN apt-get update && apt-get install -y git zip \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy the application code to the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]