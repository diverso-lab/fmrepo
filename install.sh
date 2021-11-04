#!/bin/bash
cp .env.example .env
cp createdb.sql laradock/mysql/docker-entrypoint-initdb.d/createdb.sql
git submodule update --init --recursive
cd laradock
git pull origin master
cp .env.example .env
docker-compose up -d nginx mysql phpmyadmin redis workspace
docker exec laradock_workspace rm -f composer.lock
docker exec laradock_workspace composer install
docker exec laradock_workspace php artisan migrate
docker exec laradock_workspace php artisan db:seed
docker exec laradock_workspace php artisan key:generate
docker exec laradock_workspace php artisan config:cache
