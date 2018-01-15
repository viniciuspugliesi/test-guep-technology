<?php

/*
| ------------------------------------------------------------------------------
|  User Routes
| ------------------------------------------------------------------------------
| 
| Listing user application routes
*/
$route->get('/', 'UserController@index');
$route->get('/usuarios', 'UserController@index');

$route->get('/usuarios/editar/{id}', 'UserController@index');
$route->post('/usuarios/editar/{id}', 'UserController@update');

$route->get('/usuarios/cadastar', 'UserController@create');
$route->post('/usuarios/cadastar', 'UserController@store');

$route->get('/usuarios/excluir/{id}', 'UserController@destroy');

/*
| ------------------------------------------------------------------------------
|  Group Routes
| ------------------------------------------------------------------------------
| 
| Listing group application routes
*/
$route->get('/grupos', 'GroupController@index');

$route->get('/grupos/editar/{id}', 'GroupController@index');
$route->post('/grupos/editar/{id}', 'GroupController@update');

$route->get('/grupos/cadastar', 'GroupController@create');
$route->post('/grupos/cadastar', 'GroupController@store');

$route->get('/grupos/excluir/{id}', 'GroupController@destroy');