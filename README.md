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

- Insert the sql data

```bash
./insert_sql.sh
```

- Go to `http://localhost:8080`
- Done!

## Code walkthrough

- `public_html` holds the server side php code
- `static_server` holds the image hosting platform
