## Description
This is an example implementation of a RESTful API using Laravel Lumen, a stunningly fast PHP micro-framework.

## Prerequisites
Before running the project, ensure you have the following installed on your system:

- Docker
- Google Chrome (or any other modern web browser)

## Setup
### Clone the project repository to your local machine.
    git clone https://github.com/mukolla/rest-api-lumen.git

### Navigate to the project's root directory.
    cd rest-api-lumen

### Run install script
    ./run.docker-compose.sh

## Running Migrations
To run the database migrations, execute the following command:

    docker exec lumen_api_app php artisan migrate

This command will apply the pending database migrations.

## Seeding the Database
To seed the database with initial data, use the following command:

    docker exec lumen_api_app php artisan db:seed

This command will populate the database with sample data.

## Running PHP Shell
To access the PHP shell within the Docker container, run the following command:

    docker exec -it lumen_api_app /bin/bash

This will open an interactive shell where you can run PHP commands.

## Running Adminer
To access the Adminer tool for managing the database, execute the following command:

    http://127.0.0.1:8080/?pgsql=db&username=lumen_api&db=lumen_api_db&ns=public

This will open the Adminer tool in your default web browser, allowing you to interact with the database.

## Running Mailhog
Mailhog is a tool for capturing and viewing email messages during development. To access Mailhog, run the following command:

    http://localhost:8025/#

This will open Mailhog in your web browser, where you can view any emails sent by the application.

## Import Postman collections
    https://api.postman.com/collections/3784889-1eaa71ec-7527-4cb8-82e3-c1a6cf115c8f?access_key=PMAT-01H6A34T589GJ0C9G672804SXG
