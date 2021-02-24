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

For install run:

`sh install.sh`

For start run:

`sh start.sh` 

and you are done.

Nginx will be available on Frontend Panel `localhost:80` and Admin panel `localhost:81`


Login: admin 
Password: admin
