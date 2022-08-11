FROM php:8.1-apache as base

RUN apt-get update
RUN apt-get -y install zip


RUN curl https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY ./composer.json ./
