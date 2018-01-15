<?php

namespace App\Models\Repositories;

use Lib\Models\Repository;
use App\Models\Entities\UserGroup;

class UserGroupRepository extends Repository
{
    protected function getEntity()
    {
        return UserGroup::class;
    }
}