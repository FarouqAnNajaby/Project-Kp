## Installation

Clone the repo locally:

```sh
git clone https://github.com/FarouqAnNajaby/Project-Kp.git project-kp
cd project-kp
```

Install PHP dependencies:

```sh
composer install
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Edit database configuration in .env:

```sh
DB_DATABASE=database_name
DB_USERNAME=database_username (default root)
DB_PASSWORD=database_password (default empty)
```

Run database migrations:

```sh
php artisan migrate
or
php artisan migrate --path=/database/migrations/migration_file_name.php
```

Run database seeder (optional) :

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```
