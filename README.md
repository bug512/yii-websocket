## Overview
Docker Compose configuration to run PHP 7.4 with Nginx, PHP-FPM, Memcached, PostgreSQL 13.2, Yii 1.1.23, Angular 1.8.2 and Composer.

## Install prerequisites

For now the project has been tested on Linux only.

You will need:

* [Docker CE](https://docs.docker.com/engine/installation/)
* [Docker Compose](https://docs.docker.com/compose/install)
* Git (optional)

## How to use it

### Starting Docker Compose

Checkout the repository or download the sources.

Simply run 

`docker-compose up` 

and you are done.

If you want rebuild exec 

`docker-compose up --build --force-recreate -V --always-recreate-deps  --remove-orphans`.

Set the permision to 777 in the following directories:

`chmod -R 777 web/admin/runtime`
`chmod -R 777 web/frontend/runtime`
`chmod -R 777 web/frontend/www/assets`
`chmod -R 777 web/admin/www/assets`


Run migrations

`docker-compose exec app_php php console/yiic migrate up`

Start WebSocket Server

`docker-compose exec app_php php console/yiic websocketserver start -d`


Nginx will be available on Frontend Panel `localhost:80` and Admin panel `localhost:81`


Login: admin 
Password: admin
