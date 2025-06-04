
### CMS JSON api 

---

use cli command to create user

``
php cli.php users add admin@example.com pass123asdasd
``

use dockerfile to create environment container 

docker/.Dockerfile

or use docker-compose

````
db-postgres:
    image: postgres:15.4
    restart: always
    tty: true
    ports:
      - 5432:5432
    environment:
      POSTGRES_DB: "postgres"
      POSTGRES_USER: "root"
      POSTGRES_PASSWORD: "pass"
    volumes:
      - "./docker/data/postgresql:/var/lib/postgresql"

api:
    image: api:latest
    build:
    context: ./code/shop/api
    dockerfile: ./docker/.Dockerfile
    volumes:
    - .docker/api.conf:/etc/nginx/sites-enabled/api.conf
    - .docker/xdebug:/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    - ./:/app
    user: root
    dns:
    - 8.8.8.8

- ````
