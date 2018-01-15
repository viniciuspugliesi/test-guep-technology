<?php

namespace App\Models\Entities;

use Lib\Contracts\Models\Entity as EntityContract;

class Group implements EntityContract
{
    public $primary_key = 'id';
    public $table = 'groups';
    
    public $id;
    public $name;
    public $created_at;
    public $updated_at;
}