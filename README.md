# small_shop
case study

This is [Laravel](https://laravel.com) app. see [Laravel doc](https://laravel.com/docs) for details.

## requirement

- developed with PHP 7.4 in mind
- see [Laravel requirments](https://laravel.com/docs/installation#server-requirements)

## install

 - Clone app repo: `git clone https://github.com/windigo00/small_shop.git`

 - Create database and db user or use existing.

	`CREATE DATABASE 'small_shop';`

	`CREATE USER 'small_shop'@'localhost' IDENTIFIED BY 'user_password';`

	`GRANT ALL PRIVILEGES ON small_shop.* TO 'small_shop'@'localhost';`

	`FLUSH PRIVILEGES;`

 - Copy template config file `.env.example` into `.env`.

 - Update `.env` configuration. Chiefly `DB_*` for database connection. Use db name and credentials from db setup step. (see [Laravel env setup](https://laravel.com/docs/5.8/configuration#environment-configuration]) for more)

 - Install vendor packages with composer

	`composer install`

 - Generate security key

	`php artisan key:generate`

 - Run migrations (creates db tables)

	`php artisan migrate`

 - Form more information on Laravel `artisan`, please visit [Laravel doc](https://laravel.com/docs/artisan)

## testing data
`
npm run initialize
`