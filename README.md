# how to install

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

Every account generated can be logged into with "password" and their e-mail, which you can read from your database.
