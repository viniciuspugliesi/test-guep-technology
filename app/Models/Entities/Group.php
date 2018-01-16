<?php

namespace App\Models\Entities;

use Lib\Contracts\Models\Entity as EntityContract;

class Group implements EntityContract
{
    /**
     * @var string
     */
    public $primary_key = 'id';
    
    /**
     * @var string
     */
    public $table = 'groups';
    
    /**
     * @var id
     */
    public $id;
    
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var string
     */
    public $created_at;
    
    /**
     * @var string
     */
    public $updated_at;
}