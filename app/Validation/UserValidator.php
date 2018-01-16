<?php

namespace App\Validation;

use Lib\Validation\Validator;

class UserValidator extends Validator
{
    /**
     * @var array
     */
    private $rules = [
        'first_name' => 'required|min:3|max:50',
        'last_name'  => 'required|min:3|max:50',
        'group_id'   => 'required|min_count:2',
    ];
    
    /**
     * @var array
     */
    private $messages = [
        'first_name.required' => 'O nome é obrigatório.',
        'first_name.min'      => 'O nome deve conter mais de 3 caracteres.',
        'first_name.max'      => 'O nome deve conter menos de 50 caracteres.',
        'last_name.required'  => 'O sobrenome é obrigatório.',
        'last_name.min'       => 'O sobrenome deve conter mais de 3 caracteres.',
        'last_name.max'       => 'O sobrenome deve conter menos de 50 caracteres.',
        'group_id.required'   => 'O grupo é obrigatório.',
        'group_id.min_count'  => 'O usuário deve ter no mínimo 2 grupos.',
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