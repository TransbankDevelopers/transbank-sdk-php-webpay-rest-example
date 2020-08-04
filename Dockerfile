FROM php:7.4-apache-buster
RUN apt-get update && apt-get install -y zip unzip zlib1g-dev wget libzip-dev
RUN docker-php-ext-install zip
RUN mkdir -p /app
WORKDIR /app
COPY ./composer* /app/
RUN chmod 0777 ./composer-install.sh
RUN ./composer-install.sh
COPY . /app
RUN cp .env.example .env
