<?php

use Lib\View\View;
use Lib\Redirector\Redirect;
use Lib\Url\Url;

/**
 * Function returns of views file
 *
 * @param string $view
 * @param array $paran
 * @return mixed
 */
if (!function_exists('view')) {
    function view(string $view, array $param = [])
    {
        return (new View())->render($view, $param);
    }
}

/**
 * Function returns of Redirect class
 *
 * @param string $route
 * @return mixed
 */
if (!function_exists('redirect')) {
    function redirect(string $route = '')
    {
        return new Redirect($route);
    }
}

/**
 * Function returns of Url class
 *
 * @param string $route
 * @return mixed
 */
if (!function_exists('url')) {
    function url(string $concat = '')
    {
        return new Url($concat);
    }
}

/**
 * Function returns of configs file
 *
 * @param string $config
 * @return mixed
 */
if (!function_exists('config')) {
    function config(string $config)
    {
        return include(__DIR__ . '/../../config/' . $config . '.php');
    }
}

/**
 * Function returns of configs file
 *
 * @param string $config
 * @return void
 */
if (!function_exists('dd')) {
    function dd()
    {
        $args = func_get_args();
        echo '<pre>';
        foreach ($args as $value) {
            // var_dump($value);
            print_r($value);
            echo '<br>';
        }

        die();
    }
}

/**
 * Function abort application
 *
 * @param int $code
 * @return void
 */
if (!function_exists('abort')) {
    function abort(int $code)
    {
        view('errors.' . $code);
        die();
    }
}