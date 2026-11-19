# Dockerfile
FROM php:8.2-apache

RUN apt-get update && apt-get install -y ca-certificates \
    && update-ca-certificates \
    && printf "openssl.cafile=/etc/ssl/certs/ca-certificates.crt\nopenssl.capath=/etc/ssl/certs\n" > /usr/local/etc/php/conf.d/openssl.ini \
    && rm -rf /var/lib/apt/lists/*

# Instala a extensão pdo_mysql
RUN docker-php-ext-install pdo_mysql

# Habilita mod_rewrite do Apache (opcional, bom para frameworks)
RUN a2enmod rewrite