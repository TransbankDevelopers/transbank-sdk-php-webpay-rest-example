FROM php:7.2-apache-stretch
RUN apt-get update && apt-get install -y zip unzip zlib1g-dev wget
RUN docker-php-ext-install zip
RUN mkdir -p /app
WORKDIR /app
COPY . /app
RUN chmod 0777 ./composer-install.sh
RUN ./composer-install.sh
EXPOSE 8000
