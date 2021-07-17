## Recommended System Requirements

1. PHP version 8 or above
2. Xampp or any apache server
3. Pgadmin

Note: Make sure pgsql extension is enabled.

# Installation Instructions

Run following commands.
1. composer install
2. cp .env.example //change database credentials

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