FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install PHP extensions required by CodeIgniter 4
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Move public folder as DocumentRoot
RUN rm -rf /var/www/html/html
RUN ln -s /var/www/html/public /var/www/html/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 777 writable/

# Expose port
EXPOSE 80

CMD ["apache2-foreground"]
