##################
# Variables
##################

DOCKER_COMPOSE = docker-compose -f ./docker/docker-compose.yml --env-file ./docker/.env

##################
# Docker compose
##################

dc_build:
	${DOCKER_COMPOSE} build

dc_start:
	${DOCKER_COMPOSE} start

dc_stop:
	${DOCKER_COMPOSE} stop

dc_up:
	${DOCKER_COMPOSE} up -d --remove-orphans

dc_ps:
	${DOCKER_COMPOSE} ps

dc_logs:
	${DOCKER_COMPOSE} logs -f

dc_down:
	${DOCKER_COMPOSE} down -v --rmi=all --remove-orphans

dc_restart:
	make dc_stop dc_start

dc_rebuild_up:
	make dc_stop dc_build dc_up

##################
# App
##################
app_install:
	${DOCKER_COMPOSE} exec -u www-data php-fpm cp .env.example .env
	${DOCKER_COMPOSE} exec -u www-data php-fpm composer install

app_bash:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bash