# 環境初期設定
.PHONY: init
init:
	@rm -rf ./db
	@cp ./backend/.env.example ./backend/.env
	@docker-compose up -d
	@docker-compose exec app composer install
	@docker-compose exec app php artisan key:generate
	@docker-compose exec frontend npm install
	@docker-compose down

# docker起動
.PHONY: up
up:
	@docker-compose up

# docker停止 & コンテナ削除
.PHONY: down
down:
	@docker-compose down

# Laravelコンテナに侵入
.PHONY: app
app:
	@docker-compose exec app bash

# Laravel migrate:fresh --seed
.PHONY: dbfresh
dbfresh:
	@docker-compose exec -T  app php artisan migrate:fresh --seed

# Nuxtコンテナに侵入
.PHONY: front
front:
	@docker-compose exec frontend bash

# Nuxt npm run dev
.PHONY: dev
dev:
	@docker-compose exec frontend npm run dev

# Nuxt npm run build
.PHONY: build
build:
	@docker-compose exec frontend npm run build

# Laravel Linter
.PHONY: lint
lint:
	@docker-compose exec -T app composer lint

# Laravel Formatter	
.PHONY: format
format:
	@docker-compose exec -T app composer format
