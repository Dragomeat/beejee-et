#!/usr/bin/make

SHELL := /bin/bash

docker_compose_bin = docker-compose --project-directory=./laradock -f ./laradock/docker-compose.yml

containers = workspace nginx php-fpm \
             mysql redis

.PHONY : help init start stop
.DEFAULT_GOAL := help

help: ## Show help text
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

---------------: ## Development tasks ---------------

init: configs start ## Initialize project
	${docker_compose_bin} exec --user=laradock workspace bash -c "\
	     composer install && \
	     npm i && \
	     npm run prod"
	@echo "*********************************************"
	@echo "* This project was successfully initialized *"
	@echo "*********************************************"

configs: ## Create configs if they don't exists
	test -s ./laradock/.env || cp .env.laradock.example ./laradock/.env
	cp ./migrations/* ./laradock/mysql/docker-entrypoint-initdb.d
	cp ./site.nginx.conf ./laradock/nginx/sites/default.conf
	@echo "Environment files have been created. Want to continue with default values? [Y/n]"
	@read line; if [ $$line == "n" ]; then echo Aborting; exit 1 ; fi

start: ## Run project in background
	${docker_compose_bin} up --build -d ${containers}

shell: ## Conneect to shell in workspace container
	${docker_compose_bin} exec --user=laradock workspace bash

stop: ## Stop project
	${docker_compose_bin} stop ${containers}

down: ## Uninstall project
	${docker_compose_bin} down
	rm -rf ~/.laradock/beejee-et
