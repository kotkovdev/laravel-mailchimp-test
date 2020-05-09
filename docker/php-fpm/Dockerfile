FROM phpdockerio/php73-fpm:latest
WORKDIR "/application"

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.3-mysql php7.3-pgsql php-redis php-xdebug php-imagick php7.3-odbc php7.3-soap php-yaml php7.3-zip \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && phpenmod pgsql