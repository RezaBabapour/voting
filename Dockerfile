FROM php:7.3.1-apache
RUN docker-php-ext-install mysqli
