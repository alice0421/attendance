# 環境構築
## git cloneした場合
1. ルートディレクトリに以下の`.env`ファイルを作成する。
    ```
    APP_PORT=8000
    WEB_PORT=80
    FRONT_PORT=3000
    DB_PORT=3306

    DB_NAME=dbname
    DB_USER=dbuser
    DB_PASSWORD=password
    DB_ROOT_PASSWORD=root_password
    ```
2. `$ make init`

## 一から構築する場合
### frontend (Nuxt3)
1. `$ docker-compose exec frontend bash`でfrontendコンテナに入る。
2. `$ npx nuxi@latest init . --force`でカレントディレクトリ (`/var/www/src（ = ./frontend）`) 直下にNuxt3アプリファイル群を作成する。
    - 以下のように出たら`y`でOK。
    ```
    Need to install the following packages:
        nuxi@3.6.1
    Ok to proceed? (y)
    ```
3. `$ npm install`を実行。
4. `$ npm run dev`を実行し、`localhost:3000`でNuxtアプリに接続。
5. `$ npm install axios --save`で
6. `nuxt.config.ts`に以下を記述する。
    - APIへのプロキシ設定用 (Laravel API)
    ```typescript
    vite: {
        server: {
            proxy: {
                "/api/": {
                    target: "http://web_attendance:80/api/",
                    changeOrigin: true,
                    rewrite: (path) => path.replace(/^\/api/, "")
                },
            },
        },
    }
    ```

### backend (Laravel API)
1. `$ docker-compose exec frontend bash`でappコンテナ (Laravelコンテナ) に入る。
2. `$ composer create-project --prefer-dist laravel/laravel . "9.*"`でカレントディレクトリ (`/var/www/html（ = ./backend）`) 直下にLaravel9アプリファイル群を作成する。
3. `$ php artisan key:generate`でLaravelのアプリキーを作成する。
4. `.env`ファイルに以下を追記。
    ```bash
    SANCTUM_STATEFUL_DOMAINS=localhost:3000 # Laravel Sanctumへのアクセスを許可するドメインを指定
    SESSION_DOMAIN=localhost # セッション・クッキーを許可する (フロントの) ドメインを指定 (クロスドメイン (backとfrontのドメインが違う) のため)
    ```
