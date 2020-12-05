build:
	docker-compose build

db:
	docker-compose exec mpu-auth-db psql stage -h localhost --username=postgres

attach:
	docker-compose exec mpu-auth-app /bin/bash

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
