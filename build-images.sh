#!/bin/bash

docker build -t=virt/apache ./apache
docker build -t=virt/php ./php
docker build -t=virt/node ./static_server
