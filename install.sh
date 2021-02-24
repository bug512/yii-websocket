#!/usr/bin/env bash

if [ ! -f .env ]; then
    cp .env.example .env
fi

sudo chmod -R 777 web/admin/runtime

sudo chmod -R 777 web/frontend/runtime

sudo chmod -R 777 web/frontend/www/assets

sudo chmod -R 777 web/admin/www/assets

docker-compose up -d

docker-compose exec app_php php console/yiic migrate up

docker-compose exec app_php php console/yiic websocketserver start -d

echo -e "\nDone\n"