#!/usr/bin/env bash

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -d console/runtime ]; then
    mkdir console/runtime
fi

sudo chmod -R 777 console/runtime

if [ ! -d web/admin/runtime ]; then
    mkdir web/admin/runtime
fi

sudo chmod -R 777 web/admin/runtime

if [ ! -d web/frontend/runtime ]; then
    mkdir web/frontend/runtime
fi

sudo chmod -R 777 web/frontend/runtime

if [ ! -d web/frontend/www/assets ]; then
    mkdir web/frontend/www/assets
fi

sudo chmod -R 777 web/frontend/www/assets

if [ ! -d web/admin/www/assets ]; then
    mkdir web/admin/www/assets
fi

sudo chmod -R 777 web/admin/www/assets

npm install --prefix web/admin/www/

npm install --prefix web/frontend/www/

docker-compose up -d

docker-compose exec app_php php console/yiic migrate up --interactive=0

docker-compose exec app_php php console/yiic websocketserver start -d

echo -e "\nDone\n"