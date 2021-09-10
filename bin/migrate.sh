#!/usr/bin/env sh

docker-compose exec postgres pgloader \
  mysql://opensid:opensid@mysql:3306/opensid \
  postgresql://opensid:opensid@localhost:5432/opensid