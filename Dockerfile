# Use an official PHP image with Apache as the base image
FROM php:8.2.10-apache

# Set the working directory
WORKDIR /var/www/html

# Copy PHP application files into the container
COPY . /var/www/html/

# Install PHP extensions (if needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80 for HTTP
EXPOSE 80

# Start the Apache web server
CMD ["apache2-foreground"]




