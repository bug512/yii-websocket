#!/usr/bin/env bash

docker-compose up -d

docker-compose exec app_php php console/yiic websocketserver start -d

echo -e "\nDone\n"