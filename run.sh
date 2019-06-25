#!/usr/bin/env bash
docker-compose run --rm --service-ports web php artisan serve --host=0.0.0.0 --port=8000
