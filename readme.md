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
php artisan kpi:createSuperUser
```

Then follow the instructions

# Swagger
Edit your .env file to match your configuration. You should fill the variable
```
L5_SWAGGER_BASE_PATH= {your_path}/api/v1
```
Update the Swagger docs by running 

```
php artisan l5-swagger:regenerate
```
