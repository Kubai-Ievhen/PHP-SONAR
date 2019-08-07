include .env
export

docker_name = $(DOCKER_PREFIX)-php-fpm
docker_image = $(DOCKER_PREFIX)-php-fpm
mysql_container = $(DOCKER_PREFIX)-mysql

idu = $(shell id -u)
idg = $(shell id -g)

start: #start docker container #
	@CURRENT_UID=$(idu):$(idg) docker-compose -f docker-compose-local.yml up -d

connect: #start docker container #
	@CURRENT_UID=$(idu):$(idg) docker exec -it $(docker_name) bash

stop: #stop docker container
	@docker-compose -f docker-compose-local.yml down

logs: #start docker container #
	@CURRENT_UID=$(idu):$(idg) docker-compose -f docker-compose-local.yml logs -f

lint: #create feature
	@clear; docker exec -it $(docker_name) bash -c './vendor/bin/phpstan analyse -- app && ./vendor/squizlabs/php_codesniffer/bin/phpcs -p --standard=PSR2 --colors app/'

swagger: #generate swagger docs
    @CURRENT_UID=$(idu):$(idg) docker exec -it $(docker_name) bash -c 'php artisan swagger:generate'
