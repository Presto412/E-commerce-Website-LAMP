#!/bin/bash
# set -e
docker swarm leave -f

docker swarm init
docker network create --attachable --driver overlay --subnet=10.200.1.0/24 testnet

docker stack deploy -c docker-compose.yml test
