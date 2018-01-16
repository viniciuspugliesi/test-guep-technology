<?php

namespace Lib\Redirector;

class Redirect
{
    /**
     * @var string
     */
    private $route;
    
    /**
     * Make new instance of this class
     * 
     * @param string $route
     * @return void
     */
    public function __construct(string $route = '')
    {
        $this->route = $route;
    }
    
    /**
     * Set session for message
     * 
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function with(string $key, string $value)
    {
        $_SESSION[$key] = $value;
        
        return $this;
    }
    
    /**
     * Set route to history back
     * 
     * @return $this
     */
    public function back()
    {
        $this->route = $_SESSION['history_url'];
        
        return $this;
    }
    
    /**
     * Redirect route
     * 
     * @return redirect
     */
    public function go()
    {
        header('Location: ' . $this->route);
        die();
    }
}