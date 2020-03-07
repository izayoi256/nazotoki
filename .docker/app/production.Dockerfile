FROM daisy-link/master-data-catalog-app:base

COPY --chown=www-data:www-data . /var/www/html

USER www-data

RUN \
    composer install --no-dev \
    && npm install --save \
    && npm run production \
    && rm -rf node_modules

USER root

COPY .docker/app/production.ini /usr/local/etc/php/conf.d/production.ini

ENTRYPOINT ["/entrypoint-base.sh"]
CMD ["apache2-foreground"]
