#!/bin/bash
CONTAINER_NAME=`docker ps --format="{{.Names}}" | grep mysql`
docker exec "$CONTAINER_NAME" /bin/bash -c "mysql -u root --password=pass < ./ecom_store.sql"
