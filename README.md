# how to install

## Requirements

-   composer
-   php 8.x
-   node/npm

Install dependencies on composer

```
composer install
```

Install dependencies on node

```
npm install
```

Build the CSS & JS

```
npm run build
```

Copy the env file

```
cp .env.example .env
```

Generate the application key

```
php artisan key:generate
```

Please, create a database with the name specified inside your .env file.
After that, run the migrations to create tables

```
php artisan migrate
```

Generate the test data for the application

```
php artisan db:seed
```

Run the integrated php server, the application url will be visible inside your terminal

```
php artisan serve
```

Every account generated can be logged into with "password" and their e-mail, which you can read from your database.
