<?php

namespace App\Validation;

use Lib\Validation\Validator;

class GroupValidator extends Validator
{
    /**
     * @var array
     */
    private $rules = [
        'name' => 'required|min:3|max:50',
    ];
    
    /**
     * @var array
     */
    private $messages = [
        'name.required' => 'O nome do grupo é obrigatório.',
        'name.min'      => 'O nome do grupo deve conter mais de 3 caracteres.',
        'name.max'      => 'O nome do grupo deve conter menos de 50 caracteres.',
    ];
    
    /**
     * @var array
     */
    private $data = [];
    
    /**
     * Make new instance of this class
     * 
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    /**
     * Run the validation
     * 
     * @return bool
     */
    public function check() : bool
    {
        return $this->rules($this->data, $this->rules, $this->messages)->run();
    }
}