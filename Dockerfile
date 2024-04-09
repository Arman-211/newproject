# Используем официальный образ PHP
FROM php:latest

# Устанавливаем директорию для приложения внутри контейнера
WORKDIR /var/www/html

# Копируем файлы проекта внутрь контейнера
COPY my_php_project .

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем MySQL сервер
RUN apt-get update && \
    apt-get install -y default-mysql-server

# Устанавливаем MySQL клиент
RUN apt-get install -y default-mysql-client

# Устанавливаем зависимости проекта
RUN composer install

# Указываем порт, который будет использоваться внутри контейнера для PHP
EXPOSE 8000

# Указываем порт, который будет использоваться внутри контейнера для MySQL
EXPOSE 3306

# Команда для запуска встроенного сервера PHP и MySQL
CMD ["php", "-S", "127.0.0.1:8000", "-t", ".", "index.php"] && service mysql start

