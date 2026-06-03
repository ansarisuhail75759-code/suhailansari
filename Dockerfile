# Use official PHP image with Apache pre-installed
FROM php:8.2-apache

# Set working directory inside container
WORKDIR /var/www/html

# Copy project files from local src/ to container directory
COPY src/ /var/www/html/

# Grant appropriate permissions so PHP scripts can create/write bookings.json
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

# Expose standard web server port
EXPOSE 80
