.PHONY:
.SILENT:

run-migration:
	docker exec lumen_api_app php artisan migrate

run-db-seed:
	docker exec lumen_api_app php artisan db:seed

run-php-sh:
	docker exec -it lumen_api_app /bin/bash

run-adminer:
	google-chrome http://127.0.0.1:8080/?pgsql=db&username=lumen_api&db=lumen_api_db&ns=public

run-mailhog:
	google-chrome http://localhost:8025/#
