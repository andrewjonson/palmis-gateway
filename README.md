## Recommended System Requirements

1. PHP version 8 or above
2. Xampp or any apache server
3. Pgadmin

Note: Make sure pgsql extension is enabled.

# Installation Instructions

Run following commands.
1. composer install
2. cp .env.example //change database credentials

## Install Redis

1. Run Redis.msi located in project folder

Note: Make sure you added redis to your environment variables

2. If you want to use php_redis

Copy php_redis.dll file to PHP extension \xampp\php\ext
Edit the php.ini file and add extension=php_redis.dll
Restart xampp

3. If you want to use predis

Replace the following line in config/database.php:

'client' => env('REDIS_CLIENT', 'phpredis')

to:

'client' => env('REDIS_CLIENT', 'predis')
then, add the predis dependency with composer:

composer require predis/predis

4. Try and test by typing 'ping' in your CLI. When 'pong' shows. The redis server successfully installed.

## Creating Plain Model

`php artisan make:model References/NameOfModel` //Reference Model
`php artisan make:model Transactions/NameOfModel` //Transaction Model

## Creating Model, Repository, Controller and Resource

`php artisan make:model NameOfModel -a`

## Creating Plain Controller

`php artisan make:controller NameOfController`

## Creating Model Repository

`php artisan make:repository NameOfRepository`

## Creating Repository Interface

`php artisan make:interface NameOfInterface`

## Creating migration

`php artisan make:migration create_table_name`

## Creating Form Request

`php artisan make:request NameOfRequest`

## Creating Json Resource

`php artisan make:resource NameOfResource`

## Creating Api Service

`php artisan make:api-service NameOfService`

## Creating Model Seeder

`php artisan make:seed NameOfSeeder`

## Adding Route Resource

`resource('uri', 'PathToController', $router)`

## Adding Routes

`$router->get('uri', 'PathToController@NameOfFunction')`
`$router->post('uri', 'PathToController@NameOfFunction')`
`$router->put('uri', 'PathToController@NameOfFunction')`
`$router->delete('uri', 'PathToController@NameOfFunction')`