<?php

namespace App\Models\Repositories;

use Lib\Models\Repository;
use App\Models\Entities\Group;
use Datetime;

class GroupRepository extends Repository
{
    /**
     * Get entity
     * 
     * @return \App\Models\Entities\Group
     */
    protected function getEntity()
    {
        return Group::class;
    }
    
    /**
     * Paginate results
     * 
     * @param int $take
     * @return array
     */
    public function paginate(int $take) : array
    {
        $groups = parent::paginate($take);
        
        array_map(function($group){
            $group->created_at = Datetime::createFromFormat('Y-m-d H:i:s', $group->created_at)->format('d/m/Y H:i');
            
        }, $groups);
        
        return $groups;
    }
    
    /**
     * Delete one result
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool
    {
        $query = 'SELECT * FROM user_groups WHERE group_id = ' . $id;
        
        return ($this->get($query)) ? false : parent::delete($id);
    }
}