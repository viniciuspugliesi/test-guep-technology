<?php

namespace App\Models\Entities;

use Lib\Contracts\Models\Entity as EntityContract;

class UserGroup implements EntityContract
{
    public $primary_key = 'id';
    public $table = 'user_groups';
    
    public $id;
    public $user_id;
    public $group_id;
    public $created_at;
    public $updated_at;
}