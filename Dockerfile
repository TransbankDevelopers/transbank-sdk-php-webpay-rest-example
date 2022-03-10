FROM php:7.4-apache-buster
RUN mkdir -p /app
WORKDIR /app
COPY . /app/
RUN cp .env.example .env
RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libmcrypt-dev openssl zip unzip git nodejs npm vim nano && docker-php-ext-install pdo_mysql mysqli gd iconv
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN sed -i 's/CipherString = DEFAULT@SECLEVEL=1/g' /etc/ssl/openssl.cnf
RUN a2enmod rewrite && service apache2 restart
RUN  composer install
RUN  php artisan key:generate
RUN  php artisan config:cache


