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

$route->get('/usuarios/editar/{id}', 'UserController@edit');
$route->post('/usuarios/editar/{id}', 'UserController@update');

$route->get('/usuarios/cadastrar', 'UserController@create');
$route->post('/usuarios/cadastrar', 'UserController@store');

$route->post('/usuarios/excluir/{id}', 'UserController@destroy');

/*
| ------------------------------------------------------------------------------
|  Group Routes
| ------------------------------------------------------------------------------
| 
| Listing group application routes
*/
$route->get('/grupos', 'GroupController@index');

$route->get('/grupos/editar/{id}', 'GroupController@edit');
$route->post('/grupos/editar/{id}', 'GroupController@update');

$route->get('/grupos/cadastrar', 'GroupController@create');
$route->post('/grupos/cadastrar', 'GroupController@store');

$route->post('/grupos/excluir/{id}', 'GroupController@destroy');