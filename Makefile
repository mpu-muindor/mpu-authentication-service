build:
	@echo 'Start building dev environment'
	docker-compose build

install: build
	@test -f ./src/.env && echo '.env exists' && exit 1
	@cp ./src/.env.example ./src/.env
	@echo 'Start 1/3 step | Starting container `mpu-auth-app`'
	@docker-compose up -d mpu-auth-app
	@echo 'Start 2/3 step | Key generating'
	@docker-compose exec mpu-auth-app php artisan key:generate
	@echo 'Start 3/3 step | Shutdown container `mpu-auth-app`'
	@docker-compose down mpu-auth-app
	@echo 'DONE!'

db:
	docker-compose exec mpu-auth-db psql stage -h localhost --username=postgres

attach:
	docker-compose exec mpu-auth-app /bin/bash

migrate:
	docker-compose up mpu-auth-migrator

run: start

start:
	docker-compose up -d

down: stop

stop:
	docker-compose down

run-dev:
	docker-compose up

analyse:
	cd src && $(MAKE) analyse

phpcs:
	cd src && $(MAKE) phpcs

phpcsfix:
	cd src && $(MAKE) phpcsfix

inithooks:
	git config core.hooksPath githooks
