.PHONY: init
init:
	@rm -rf ./db
	@cp ./backend/.env.example ./backend/.env
	@docker-compose up -d
	@docker-compose exec app composer install
	@docker-compose exec app php artisan key:generate
	@docker-compose exec frontend npm install
	@docker-compose down

.PHONY: up
up:
	@docker-compose up

.PHONY: down
down:
	@docker-compose down

.PHONY: app
app:
	@docker-compose exec app bash

.PHONY: front
front:
	@docker-compose exec frontend bash

.PHONY: dev
dev:
	@docker-compose exec frontend npm run dev

.PHONY: build
build:
	@docker-compose exec frontend npm run build

.PHONY: lint
lint:
	@docker-compose exec app ./vendor/bin/phpstan analyse
