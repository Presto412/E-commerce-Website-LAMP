# IWP Project - All in one E-commerce store

## Prerequisites

- Docker, Docker-compose, Docker-Swarm
- Ubuntu 18.04 OS

## Instructions

- Build the images

```bash
./build-images.sh
```

- Setup the Swarm Network

```bash
./setup-swarm.sh
```

- Wait for the DB to initialize, up to 2 minutes
- You can check the status by

```bash
CONTAINER_NAME=`docker ps --format="{{.Names}}" | grep mysql`
docker logs -f "$CONTAINER_NAME"
```

- Insert the sql data

```bash
./insert_sql.sh
```

- After completion, Go to `http://0.0.0.0:8080`
- Done!

## Code walkthrough

- `public_html` holds the server side php code
- `static_server` holds the image hosting platform that compresses image on demand
- `php` and `apache` hold the docker configuration
- `docker-compose.yml` holds the configuration for running docker services
- `ecom_store.sql` holds the initialization database (table creation, sample records)
