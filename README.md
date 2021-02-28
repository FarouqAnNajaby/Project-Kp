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

Edit database config in .env:

```sh
php artisan key:generate
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder (optional) :

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```
