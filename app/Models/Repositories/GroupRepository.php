<?php

namespace App\Models\Repositories;

use Lib\Models\Repository;
use App\Models\Entities\Group;

class GroupRepository extends Repository
{
    protected function getEntity()
    {
        return Group::class;
    }
}