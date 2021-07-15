<?php

function resource($uri, $controller, $router)
{
	$version = config('app.version');
	$router->get($uri, $version.'\\'.$controller.'@index');
	$router->post($uri, $version.'\\'.$controller.'@store');
	$router->put($uri.'/{id}', $version.'\\'.$controller.'@update');
	$router->delete($uri.'/{id}', $version.'\\'.$controller.'@destroy');
    $router->put($uri.'/restore/{id}', $version.'\\'.$controller.'@restore');
    $router->get($uri.'/onlyTrashed', $version.'\\'.$controller.'@onlyTrashed');
    $router->delete($uri.'/force-delete/{id}', $version.'\\'.$controller.'@forceDelete');
}