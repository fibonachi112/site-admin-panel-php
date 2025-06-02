FROM phalconphp/cphalcon:v5.9.2-php8.4

USER root

RUN apt update && apt install -y nginx && rm  /etc/nginx/sites-enabled/default

ENTRYPOINT /app/docker/entrypoint.sh

