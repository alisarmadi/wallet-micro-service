# docker/php/Dockerfile
FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install -y openssl zip unzip git curl
RUN apt-get install -y libzip-dev libonig-dev libicu-dev
RUN apt-get install -y autoconf pkg-config libssl-dev
RUN apt-get install -y supervisor cron

RUN docker-php-ext-install bcmath mbstring intl opcache

RUN docker-php-ext-install pdo pdo_mysql opcache mbstring

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php && composer config --global repos.packagist composer https://packagist.org

COPY supervisors.conf /etc/supervisor/conf.d/supervisors.module.conf
COPY php-cron /etc/cron.d/php-cron
RUN chmod 0644 /etc/cron.d/php-cron
RUN crontab /etc/cron.d/php-cron

COPY migrate.sh /tmp/
RUN chmod +x /tmp/migrate.sh

ENTRYPOINT ["/tmp/migrate.sh"]
