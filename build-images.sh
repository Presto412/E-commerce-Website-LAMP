#!/bin/bash

docker build -t=iwp/apache ./apache
docker build -t=iwp/php ./php
docker build -t=iwp/node ./static_server
