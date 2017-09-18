# Installation Instructions

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

php artisan migrate --seed

```

your app should be ready

# Admin Panel
First create a new admin user through command line
```
php artisan kpi:createSuperAdmin
```

Then follow the instructions
