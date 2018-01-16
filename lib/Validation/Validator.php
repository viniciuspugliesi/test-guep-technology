<?php

namespace Lib\Validation;

class Validator
{
    /**
     * @var array
     */
    private $messages = [
        'required'  => 'The field $key is required',
        'max'       => 'The field $key must be smaller what $key2',
        'min'       => 'The field $key must be large what $key2',
        'min_count' => 'The field $key must have a minimum of $key2',
    ];
    
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $rules = [];
    
    /**
     * @var array
     */
    private $restriction = [];
    
    /**
     * Rules for validation
     * 
     * @param array $input
     * @param array $rules
     * @param array $messages (optional)
     * @return $this
     */
    public function rules(array $input, array $rules, array $messages = [])
    {
        foreach ($messages as $key => $message) {
            $this->setMessage($key, $message);
        }
        
        $this->rules       = $input;
        $this->restriction = $rules;
        
        return $this;
    }
    
    /**
     * Run the form validation
     *
     * @return bool
     */
    public function run()
    {
        $validator = true;
        
        foreach ($this->restriction as $key => $values) {
            $values = explode('|', $values);
            
            foreach ($values as $value) {
                if (!$this->make($this->rules[$key], $value, $key)) {
                    $validator = false;
                }
            }
        }
        
        return $validator;
    }
    
    /**
     * Make each validation fields
     *
     * @param mixed $param
     * @param string $restriction
     * @param string $key
     * @return bool
     */
    public function make($param, string $restriction, string $key = '') : bool
    {
        $response = true;
        
        // Verify if existis the caracter '[' for validations (max_length, min_length, is_unique, in_list)
        if (strpos($restriction, ':')) {
            $restriction_explode = explode(':', $restriction);
            
            $others      = $restriction_explode[1];
            $restriction = $restriction_explode[0];
        }
        
        // Search what validation must be applied for that rule
        switch ($restriction) {
            case 'required':
                if (!$param) {
                    $response = false;
                    $this->setErrors($key, 'required');
                }
                break;
                
            case 'max':
                if (strlen($param) > $others)     {
                    $response = false;
                    $this->setErrors($key, 'max', $others)   ;
                }
                break;
                
            case 'min':
                if (strlen($param) < $others)     {
                    $response = false;
                    $this->setErrors($key, 'min', $others)   ;
                }
                break;
            
            case 'min_count':
                if (count($param) < $others)     {
                    $response = false;
                    $this->setErrors($key, 'min_count', $others)   ;
                }
                break;
        }
        
        return $response;
    }
    
    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
    
    /**
     * Get first error
     *
     * @return string
     */
    public function firstError() : string
    {
        return ($this->errors[0]) ?? '';
    }
    
    /**
     * Set one error in array of errors
     *
     * @param string $key
     * @param string $restriction
     * @param string $key2
     * @return $this
     */
    public function setErrors(string $key, string $restriction, string $key2 = '')
    {
        if (isset($this->messages[$key.'.'.$restriction])) {
            $message = $this->messages[$key.'.'.$restriction];
        } else {
            $message = $this->messages[$restriction];
        }
        
        if (!$key2) {
            $this->errors[] = str_replace('$key', $key, $message);
        } else {
            $this->errors[] = str_replace(['$key', '$key2'], [$key, $key2], $message);
        }
        
        return $this;
    }
    
    /**
     * Set error message
     *
     * @param string $key
     * @param string $message
     * @return $this
     */
    public function setMessage(string $key, string $message)
    {
        $this->messages[$key] = $message;
        
        return $this;
    }
}