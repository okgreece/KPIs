#Installation Instructions

```
composer install

npm install

gulp

cp .env.example .env
cp database/database.sqlite.new database/database.sqlite

```

edit the .env file to reflect your endpoint

```
php artisan key:generate

php artisan migrate 

php artisan db:seed
```

your app should be ready

#Admin Panel
go to app-url/admin
register a new user and access the admin panel