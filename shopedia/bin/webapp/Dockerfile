FROM php:7.2-apache

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY src/ /var/www/html/
