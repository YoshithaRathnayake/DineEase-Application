# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Install necessary PHP extensions and dependencies
RUN docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli && \
    apt-get update && \
    apt-get install -y libpng-dev && \
    apt-get clean

WORKDIR /src/registration

# Copy your web application files into the container
COPY ./src /var/www/html

# Expose port 80 for the web server
EXPOSE 80

# Start the Apache web server
CMD ["apache2-foreground"]
