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
3. `backend/.env`に以下を追記。
    ```bash
    SANCTUM_STATEFUL_DOMAINS=localhost:3000 # Laravel Sanctumへのアクセスを許可するドメインを指定
    SESSION_DOMAIN=localhost # セッション・クッキーを許可する (フロントの) ドメインを指定 (クロスドメイン (backとfrontのドメインが違う) のため)
    ```

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

# 個人的な設計思想
※ あくまで個人的な解釈なので、誤っている可能性大。

> 参考
> - [Laravelでクリーンアーキテクチャを実現する4つのディレクトリ構成例](https://aichi.blog/2023/04/2947/)
> - [Laravelのディレクトリ構造を公開！](https://www.wantedly.com/companies/noschool/post_articles/306528)
> - [LaravelでAPI開発を効率化！分離型アーキテクチャのDDDとカスタマイズ可能なディレクトリ構成を活用しよう](https://aichi.blog/2023/04/2983/)
> - [Laravelで実践クリーンアーキテクチャ](https://qiita.com/nrslib/items/aa49d10dd2bcb3110f22)
> - [俺的Laraveでのクリーンアーキテクチャー考察](https://kami-programming.com/programming/laravel/clean-architecture-sample)
> - [Laravelでドメイン駆動設計(DDD)を実践し、Eloquent Model依存の設計から脱却する](https://qiita.com/mejileben/items/302a9f502ca0801b1efb)
> - [DDD基礎解説：Entity、ValueObjectってなんなんだ](https://little-hands.hatenablog.com/entry/2018/12/09/entity-value-object)
> - [DDDでのDTOの使い所](https://zenn.dev/miya_tech/articles/5d1c7f8df08557)
> - [DDDの各層について](https://qiita.com/Waka0830/items/811a3ef4e7ae1a2fcb38)
> - [お前らがModelと呼ぶアレをなんと呼ぶべきか。近辺の用語(EntityとかVOとかDTOとか)について整理しつつ考える](https://qiita.com/takasek/items/70ab5a61756ee620aee6)
> - [ddd-backend-with-laravel
](https://github.com/hiroki-it/ddd-backend-with-laravel/tree/master)

## DDD × クリーンアーキテクチャ
以下2つを組み合わせ、自分なりにAPIに特化していると思うLaravelのアーキテクチャを設計してみた。

### DDD (ドメイン駆動設計) 
DDD (ドメイン駆動設計) とは、エリック・エバンズが提唱した、ユーザーが従事する業務に合わせてソフトウェアを解決する設計手法。

### クリーンアーキテクチャ
クリーンアーキテクチャとは、Robert C. Martin (Uncle Bob) が2012年に提唱した、DBやフレークワークからの独立性を確保するためのアーキテクチャである。

## ディレクトリ構造
```bash
src/app/Domains
├── Auth # 業務 (ドメイン) の名前
│   ├── Domain # ドメインを記述する場所 (技術者以外にも分かるように)
│   │   ├── Entities # Repositoryで扱う型
│   │   ├── Exceptions # ドメインのException (エラー) 処理
│   │   ├── Repositories # RepositoryのInterface
│   │   └── ValueObjects # Entityの属性となる値
│   ├── Infrastructure # ドメインを技術的に実装する場所 (技術者向け)
│   │   └── Repositories # Repositoryの実装クラス
│   └── UseCase # UseCaseの実装クラス (1ユースケース1メソッド)
│       └── DTOs # UseCaseで扱う型
...以下略...
```

```bash
src/app/Http/Controllers # 1アクション1コントローラー
├── Api
│   ├── # [各機能ごとにディレクトリを作成]
│   ...
└── Auth # 認証系だけ別枠でディレクトリ作成
```

### 基本構造
- Domain
    - ドメイン (業務) を技術者以外にも分かるように記述する場所。
        - 例) Auth (認証機能があることを示す)
- UseCase
    - ドメイン内の実際の業務内容を記述する場所。このアプリケーションが何をできるのかを表す。
        - 例) UserLoginUseCase (認証機能には、ユーザーログイン機能があることを示す)
    - 今回は、1ユースケース1メソッド (`execute`メソッドのみ) とする。
- Repository
    - Usecaseで示された業務内容を、実際に技術的に実装する場所。主にDB関連の操作を行う。
        - 例) UserLoginRepository (ユーザーログイン機能のためのログイン認証を、DBを介して実際に技術的に実装)
    - 今回は、インターフェースと実装クラスに分けて設計する。
- Entity
    - 複数の属性を含有する可変なオブジェクトとして定義。属性としてValueObjectを保持する。
- ValueObject
    - 不変な値として定義。プリミティブ型よりも強固な型を作れる。Entityの属性になる。
        - 例) DBに渡すものをプリミティブ型にするとバグの温床になりかねないため、Repositoryの引数と返り値はより強固なValueObjectにすると良い。
  ```php
  // people全体がEntity
  people [
      'id' => 's0001', // 属性1つ1つがValueObject
      'name' => 'sample',
      'age' => 20,
  ]
  ```
- DTO (Data Transfer Object)
    - Entityのようなものであるが、Entityとは異なり、ある処理や他の文脈への転送のためだけに使われる。
- Infrastructure
    - ドメインを技術者向けに技術的に実装する場所。
        - 今回は、Domain内にInterfaceを記述し、実装クラスをInfrastructureに記述する。
- Controllers
    - APIからRequestを受け取り、レスポンスを返す。実際の挙動詳細は全部UseCaseに任せる。
    - 今回は[シングルアクションコントローラー](https://readouble.com/laravel/9.x/ja/controllers.html#:~:text=%E3%81%A7%E3%81%8D%E3%81%BE%E3%81%9B%E3%82%93%E3%80%82-,%E3%82%B7%E3%83%B3%E3%82%B0%E3%83%AB%E3%82%A2%E3%82%AF%E3%82%B7%E3%83%A7%E3%83%B3%E3%82%B3%E3%83%B3%E3%83%88%E3%83%AD%E3%83%BC%E3%83%A9,-%E3%82%B3%E3%83%B3%E3%83%88%E3%83%AD%E3%83%BC%E3%83%A9%E3%81%AE%E3%82%A2%E3%82%AF%E3%82%B7%E3%83%A7%E3%83%B3) (1アクション1コントローラー) を使用する。
     
### +αの構造
- Exception
    - ドメインごとのException (エラー) 処理を記述。

# データの流れ
- 現在の層よりも1つ下の層しか操作できない。
    - 例) UseCaseはRepositoryのみ扱える。直接DBは扱えないし、Controllerも使えない。
- 現在の層の上下の繋ぎしか操作できない。
    - 例) UseCaseはDTOを引数と返り値に取る。UseCaseの中ではRepositoryを扱うので、Repositoryの引数と返り値であるEntityも扱える。
- 現在の繋ぎよりも1つ下の繋ぎしか操作できない。
    - 例) DTOからEntityを作成する (`DTO->toEntity()`) ことはできるが、EntityからDTOを作成する (`VO::createFromDTO()`) ことはできない。

### Request
```
[API]

↓ Request

[Controller]

↓ DTO (属性はプリミティブ型)

[UseCase]

↓ Entity (属性はValueObject)

[Repository]

↓ (Eloquent Model)

[DB]
```

### Response
```
[API]

↑ Response

[Controller]

↑ DTO (属性はプリミティブ型)

[UseCase]

↑ Entity (属性はValueObject)

[Repository]

↑ (Eloquent Model)

[DB]
```

# 開発Tips
## back
- PostmanでのAPI挙動テスト時、`app/Http/Kernel.php`の`'throttle:api'`はコメントアウトすること。
  - 外さないと、同ドメインからの1分あたりのリクエスト回数が制限される。

## front
