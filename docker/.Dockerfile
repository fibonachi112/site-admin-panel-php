FROM phalconphp/cphalcon:v5.9.2-php8.4

USER root

RUN apt update && apt install -y nginx && rm  /etc/nginx/sites-enabled/default
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN apt install -y curl wget htop
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php ./composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

RUN composer global require phalcon/devtools:"^5.0@dev" --dev \
    && echo 'export PATH="/root/.composer/vendor/bin:$PATH"' >> ~/.bashrc \
    && source ~/.bashrc

ENTRYPOINT /app/docker/entrypoint.sh

