<?php

namespace Lib\Url;

class Url
{
    /**
     * @var string
     */
    private $url;
    
    /**
     * Make new instance of this class
     * 
     * @param string $concat
     * @return void
     */
    public function __construct(string $concat)
    {
        $this->url = $this->baseUrl() . $concat;
    }
    
    /**
     * Get base URL
     * 
     * @return string
     */
    private function baseUrl() : string
    {
        return (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    }
    
    /**
     * Get current url
     * 
     * @return string
     */
    public function current() : string
    {
        return explode('?', $this->baseUrl() . $_SERVER['REQUEST_URI'])[0];
    }
    
    /**
     * Get full current url
     * 
     * @return string
     */
    public function full() : string
    {
        return $this->baseUrl() . $_SERVER['REQUEST_URI'];
    }
    
    /**
     * Convert to string
     * 
     * @return string
     */
    public function __toString() : string
    {
        return $this->url;
    }
}