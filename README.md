# お問い合わせフォーム

## 環境構築

### Dockerビルド

1. リポジトリをクローンします。  
`git clone git@github.com:Gerol-steiner/20240929_TEST_LARAVEL.git`

2. Dockerコンテナをビルドして起動します。  
`docker-compose up -d --build`  


* MySQLはOSによって起動しない場合があるため、各PCに合わせて `docker-compose.yml` ファイルを編集してください。

### Laravel環境構築

1. PHPコンテナに入ります。  
`docker-compose exec php bash`  

2. Composerで依存関係をインストールします。
`composer install`


3. `.env.example` ファイルから `.env` ファイルを作成し、環境変数を設定します。
4. アプリケーションキーを生成します。  
`php artisan key:generate`


5. マイグレーションを実行します。  
`php artisan migrate`


6. データベースシードを実行します。  
`php artisan db:seed`  

## データベース設計  
![image](https://github.com/user-attachments/assets/35c36338-670a-4bdb-9219-aa6b371ea81c)  
  
## 使用技術

- PHP 7.4.9
- Laravel 8.83.27
- MySQL 8.0.39

## URL

- 開発環境: [http://localhost/](http://localhost/)
- phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)



