<?php

namespace Lib\View;

class View
{
    /**
     * Render view
     * 
     * @param string $view
     * @param array $parameters
     * @return mixed
     */
    public function render(string $view, array $params = [])
    {
        if ($params) {
            extract($params);
        }
        
        $view = str_replace('.', '/', $view);
        
        return include(__DIR__ . '/../../app/resources/views/' . $view . '.php');
    }
}