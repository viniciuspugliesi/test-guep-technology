<?php

namespace App\Models\Entities;

use Lib\Contracts\Models\Entity as EntityContract;

class User implements EntityContract
{
    /**
     * @var string
     */
    public $primary_key = 'id';
    
    /**
     * @var string
     */
    public $table = 'users';
    
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     */
    public $first_name;
    
    /**
     * @var string
     */
    public $last_name;
    
    /**
     * @var string
     */
    public $created_at;
    
    /**
     * @var string
     */
    public $updated_at;
}