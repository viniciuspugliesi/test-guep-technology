<?php

namespace Lib\Routing;

class Router
{
    /**
     * @var string
     */
    private $base_url;
    
    /**
     * @var array
     */
    private $params = [];
    
    /**
     * Make new instance of this class
     * 
     * @return void
     */
    public function __construct()
    {
        $this->base_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    }
    
    /**
     * Run routes
     * 
     * @return abort
     */
    public function run()
    {
        $full_url = $this->removeGetParams($this->base_url . $this->handlerUrl($_SERVER['REQUEST_URI']));
        
        foreach ($this->routes as $route) {
            if ($this->validate($full_url, $route['url'])) {
                $_SESSION['history_url'] = $_SESSION['current_url'] ?? $full_url;
                $_SESSION['current_url'] = $full_url;
                return $this->handlerCallback($route['callback']);
            }
        }
        
        return abort(404);
    }
    
    /**
     * Remove get params
     * 
     * @param string $url
     * @return string
     */
    private function removeGetParams(string $url) : string
    {
        return explode('?', $url)[0];
    }
    
    /**
     * Validate route
     * 
     * @param string $full_url
     * @param string $url
     * @return bool
     */
    private function validate(string $full_url, string $url) : bool
    {
        $url = $this->base_url . $this->handlerUrl($url);
        
        if (preg_match_all('/[{]+[a-z]*[}]/', $url, $matches)) {
            
            foreach ($matches as $matche) {
                $url = $this->handlerParams($full_url, $url, $matche[0]);
            }
        }
        
        return $full_url === $url;
    }
    
    /**
     * Handles url
     * 
     * @param string $url
     * @return string
     */
    private function handlerUrl(string $url) : string
    {
        if (substr($url, -1) === '/') {
            return substr($url, 0, -1);
        }
        
        return $url;
    }
    
    /**
     * Handles callback
     * 
     * @param string $callback
     * @return callback
     */
    private function handlerCallback(string $callback)
    {
        $data = explode('@', $callback);
        
        $controller = $data[0];
        $action     = $data[1];
        
        $controller = new $controller();
        
        return call_user_func_array([$controller, $action], $this->params);
    }
    
    /**
     * Handles parameters
     * 
     * @param string $full_url
     * @param string $url
     * @param string $matche
     * @return string
     */
    private function handlerParams(string $full_url, string $url, string $matche) : string
    {
        $position = strripos($url, $matche);
        
        $replace = explode('/', substr($full_url, $position))[0];
        
        $this->setParams($matche, $replace);
        
        return str_replace($matche, $replace, $url);
    }
    
    /**
     * Set parameters
     * 
     * @param string $key
     * @param string $value
     * @return $this
     */
    private function setParams(string $key, string $value)
    {
        $key = substr(substr($key, 1), 0, -1);
        
        $this->params[$key] = $value;
        
        return $this;
    }
}