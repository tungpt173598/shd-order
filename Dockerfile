FROM php:8.1-fpm

RUN apt-get update && apt-get install -y zip

RUN docker-php-ext-install pdo pdo_mysql

# Set lại thư mục làm việc
WORKDIR /var/www/html

# Copy mã nguồn Laravel vào container
COPY . .

# Set lại quyền sở hữu
RUN chown -R www-data:www-data /var/www/html/

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1
# Cài đặt dependencies của Laravel bằng Composer
RUN composer install

# Mở cổng 9000 cho PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
