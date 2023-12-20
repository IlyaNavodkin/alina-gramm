# Используем официальный образ PHP 8.3.0 с FPM
FROM php:8.3.0-fpm

# Устанавливаем необходимые зависимости
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo_mysql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Назначаем рабочую директорию
WORKDIR /var/www/html

# Копируем файлы проекта в контейнер
COPY . /var/www/html

# Устанавливаем зависимости Laravel
RUN composer install --optimize-autoloader --no-dev

# Команда по умолчанию для запуска приложения
CMD php artisan serve --host=0.0.0.0 --port=80
