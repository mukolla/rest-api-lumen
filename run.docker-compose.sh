#!/bin/bash
log_message()
{
    LOG_PREFIX="[$(date '+%Y-%m-%d %H:%M:%S')][rebuild]"
    MESSAGE=$1
    echo "$LOG_PREFIX $MESSAGE"
}


log_message "Stopping containers..."
docker compose -p lumen_api stop

log_message "Removing containers..."
docker compose -p lumen_api rm -f

log_message "Starting containers..."
docker compose -p lumen_api up -d --remove-orphans --build
