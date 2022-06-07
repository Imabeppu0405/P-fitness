FROM php:7.4-apache
LABEL maintainer="imabeppu"

RUN apt-get update \
  && apt-get install -y zlib1g-dev libpq-dev mariadb-client unzip libzip-dev\
  && docker-php-ext-install zip pdo_mysql mysqli \
  && docker-php-ext-enable mysqli

RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
RUN ln -s /etc/apache2/mods-available/vhost_alias.load /etc/apache2/mods-enabled
RUN echo ServerName $HOSTNAME:80 > /etc/apache2/conf-available/fqdn.conf && a2enconf fqdn

COPY ./vhost.conf /etc/apache2/sites-available/vhost.conf
RUN a2ensite vhost.conf

COPY ./php.ini /usr/local/etc/php/

WORKDIR /var/www/work
