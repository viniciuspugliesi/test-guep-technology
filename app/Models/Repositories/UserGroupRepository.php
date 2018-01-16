<?php

namespace App\Models\Repositories;

use Lib\Models\Repository;
use App\Models\Entities\UserGroup;

class UserGroupRepository extends Repository
{
    /**
     * Get entity
     * 
     * @return \App\Models\Entities\UserGroup
     */
    protected function getEntity()
    {
        return UserGroup::class;
    }
}