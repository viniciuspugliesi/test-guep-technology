<?php

namespace Lib\Routing;

use Lib\Routing\Router;

class Route extends Router
{
    /**
     * @var array
     */
    protected $routes = [];
    
    /**
     * Any Request Method
     * 
     * @param string $url
     * @param string $callback
     * @return void
     */
    public function any(string $url, string $callback)
    {
        $this->setters($url, $callback);
    }
    
    /**
     * Get Request Method
     * 
     * @param string $url
     * @param string $callback
     * @return void
     */
    public function get(string $url, string $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            return false;
        }
        
        $this->setters($url, $callback);
    }
    
    /**
     * Post Request Method
     * 
     * @param string $url
     * @param string $callback
     * @return void
     */
    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return false;
        }
        
        $this->setters($url, $callback);
    }
    
    /**
     * Put Request Method
     * 
     * @param string $url
     * @param string $callback
     * @return void
     */
    public function put()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
            return false;
        }
        
        $this->setters($url, $callback);
    }
    
    /**
     * Delete Request Method
     * 
     * @param string $url
     * @param string $callback
     * @return void
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
            return false;
        }
        
        $this->setters($url, $callback);
    }
    
    /**
     * Setters attributes
     * 
     * @param string $url
     * @param string $callback
     * @return void
     */
    private function setters(string $url, string $callback)
    {
        $this->routes[] = [
            'url'      => $url,
            'callback' => '\App\Controllers\\' . $callback,
        ];
    }
}