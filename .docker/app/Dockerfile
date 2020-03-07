FROM php:7.4.3-apache as base

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN \
    set -x \
    && apt-get update \
    && apt-get install -y \
        git \
        iproute2 \
        sudo \
        unzip \
        wget \
        libzip-dev \
    && docker-php-ext-install \
        zip \
    && chown www-data:www-data /var/www \
    && sudo -u www-data composer config -g repos.packagist composer https://packagist.jp \
    && sudo -u www-data composer global require --optimize-autoloader hirak/prestissimo \
    && apt-get clean \
    && rm -rf /tmp/*

RUN \
    apt-get update \
    && apt-get install -y \
        npm \
    && npm install -g npm@latest \
    && sed -i -e "s/\/var\/www\/html/\/var\/www\/html\/public/" /etc/apache2/sites-available/000-default.conf \
    && docker-php-ext-install \
        bcmath \
    && a2enmod rewrite \
    && echo "ServerTokens Prod" >> /etc/apache2/conf-available/security.conf \
    && apt-get clean \
    && rm -rf /tmp/*

COPY .docker/app/base.ini /usr/local/etc/php/conf.d/base.ini
COPY .docker/app/entrypoint-base.sh /entrypoint-base.sh
ENTRYPOINT ["/entrypoint-base.sh"]
CMD ["apache2-foreground"]

FROM base AS dev

RUN \
    pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /tmp/*

COPY .docker/app/dev.ini /usr/local/etc/php/conf.d/dev.ini
COPY .docker/app/entrypoint-dev.sh /entrypoint-dev.sh
ENTRYPOINT ["/entrypoint-dev.sh"]
CMD ["apache2-foreground"]
