#!/bin/bash

docker stack deploy -c docker-compose-apache.yaml testnet
docker exec -it "$CONTAINER_NAME" apt install php libapache2-mod-php php-mysql
