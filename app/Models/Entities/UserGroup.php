<?php

namespace App\Models\Entities;

use Lib\Contracts\Models\Entity as EntityContract;

class UserGroup implements EntityContract
{
    /**
     * @var string
     */
    public $primary_key = 'id';
    
    /**
     * @var string
     */
    public $table = 'user_groups';
    
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var int
     */
    public $user_id;
    
    /**
     * @var int
     */
    public $group_id;
    
    /**
     * @var string
     */
    public $created_at;
    
    /**
     * @var string
     */
    public $updated_at;
}