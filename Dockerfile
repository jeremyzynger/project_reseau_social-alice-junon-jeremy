FROM php:7.4-apache

# Install MySQL client
RUN apt-get update && \
    apt-get install -y default-mysql-client && \
    docker-php-ext-install mysqli pdo pdo_mysql && \
    a2enmod rewrite
# Set the ServerName directive for Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy the contents of your PHP application into the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Expose the port used by Apache
EXPOSE 80
