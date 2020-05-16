FROM phpdockerio/php72-fpm:latest
WORKDIR "/application"

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.2-mysql php7.2-sqlite php7.2-pgsql php-redis php-xdebug php-imagick php7.2-odbc php7.2-soap php-yaml php7.2-zip \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && phpenmod pgsql