<?php

$router->group(['prefix' => '/api/contracts'], function() use ($router) {
    $router->get('/', 'ContractsController@getAll');
    $router->get('/{id}', 'ContractsController@get');
    $router->post('/', 'ContractsController@store');
    $router->put('/', 'ContractsController@update');
    $router->delete('/{id}', 'ContractsController@destroy');
});

$router->group(['prefix' => '/api/parts'], function() use ($router) {
    $router->get('/', 'PartsController@getAll');
    $router->get('/{id}', 'PartsController@get');
    $router->post('/', 'PartsController@store');
    $router->put('/', 'PartsController@update');
    $router->delete('/{id}', 'PartsController@destroy');
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
