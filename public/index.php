<?php

register_shutdown_function('error_alert'); 
function error_alert() {
    if (!$e = error_get_last()) {
        return;
    }
    
    if (defined('STDIN')) {
        return;
    }
    
    return abort(500, ['e' => $e]);
}

header('Content-Type: text/html; charset=utf-8');

date_default_timezone_set('America/Sao_Paulo');

session_start();

/*
| ------------------------------------------------------------------------------
|  Autoload
| ------------------------------------------------------------------------------
| 
| Require vendor autoload
*/
require __DIR__ . '/../vendor/autoload.php';

/*
| ------------------------------------------------------------------------------
|  Instance Route
| ------------------------------------------------------------------------------
| 
| Instance Route class application
*/
$route = new \Lib\Routing\Route();

/*
| ------------------------------------------------------------------------------
|  Routes
| ------------------------------------------------------------------------------
| 
| Require application routes
*/
require __DIR__ . '/../app/routes.php';

/*
| -------------------------------------------------------------------
|  Run the applicaiton routes
| -------------------------------------------------------------------
|
|  Call the run application for roll in route
*/
$route->run();