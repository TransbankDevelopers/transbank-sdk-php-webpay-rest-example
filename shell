#!/usr/bin/env bash
if [ -z "$1" ]
  then
    docker-compose exec --user www-data web bash
else
    docker-compose exec --user $@ web bash
fi
