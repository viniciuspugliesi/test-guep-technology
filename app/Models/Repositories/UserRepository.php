<?php

namespace App\Models\Repositories;

use Lib\Models\Repository;
use App\Models\Entities\User;

class UserRepository extends Repository
{
    protected function getEntity()
    {
        return User::class;
    }
}