API=logComex

install:
	cd ./logComex/ && cp .env.example .env
	chmod -R 777 ./logComex/storage/
	make up
	make compose_install
	make migrate
	docker ps
	make link
up:
	docker-compose up -d
	docker ps
	make link
down:
	docker-compose down

bash:
	docker exec -it $(API) bash

build:
	docker-compose build

seed:
	docker exec -t $(API) php artisan db:seed

compose_install:
	docker exec -t $(API) composer install
	docker exec -t $(API) php artisan key:generate

migrate:
	docker exec -t $(API) php artisan migrate

link:
	 echo Clique aqui para abrir http://localhost
