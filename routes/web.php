<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => 'auth', 'prefix' => config('app.version').'/NameOfModule'], function() use($router) {
    //resource('ranks', 'References\RankController', $router);
});
