#!/usr/bin/env bash

docker-compose exec postgres pg_dump postgres://opensid:opensid@localhost:5432/opensid | gzip -9 > dump.sql.gz
