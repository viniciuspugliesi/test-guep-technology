<?php

namespace App\Models\Entities;

use Lib\Contracts\Models\Entity as EntityContract;

class User implements EntityContract
{
    public $primary_key = 'id';
    public $table = 'users';
    
    public $id;
    public $first_name;
    public $last_name;
    public $created_at;
    public $updated_at;
}