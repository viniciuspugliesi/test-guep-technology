<?php

namespace App\Models\Repositories;

use Lib\Models\Repository;
use App\Models\Entities\User;
use App\Models\Repositories\UserGroupRepository;
use Datetime;

class UserRepository extends Repository
{
    /**
     * Get entity
     * 
     * @return \App\Models\Entities\User
     */
    protected function getEntity()
    {
        return User::class;
    }
    
    /**
     * Paginate results
     * 
     * @param int $take
     * @return array
     */
    public function paginate(int $take) : array
    {
        $users = parent::paginate($take);
        
        array_map(function($user){
            $user->groups = [];
            $query = 'SELECT g.name FROM groups as g, user_groups as ug WHERE g.id = ug.group_id AND ug.user_id = ' . $user->id;
            
            foreach ($this->get($query) as $group) {
                $user->groups[] = $group['name'];
            }
            
            $user->created_at = Datetime::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d/m/Y H:i');
            
        }, $users);
        
        return $users;
    }
    
    /**
     * Create new register
     * 
     * @param array $data
     * @return bool
     */
    public function create(array $data) : bool
    {
        parent::create($data);
        
        return $this->joinWithGroups($this->lastID(), $data['group_id']);
    }
    
    /**
     * Join user with groups
     * 
     * @param array $groups
     * @return bool
     */
    private function joinWithGroups(int $id, array $groups) : bool
    {
        $user_group = new UserGroupRepository();
        
        foreach ($groups as $group_id) {
            $user_group->create([
                'user_id'  => $id,
                'group_id' => $group_id,
            ]);
        }
        
        return true;
    }
    
    /**
     * Update one result
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data) : bool
    {
        $this->execute('DELETE FROM user_groups WHERE user_id = ' . $id);
        
        parent::update($id, $data);
        
        return $this->joinWithGroups($id, $data['group_id']);
    }
    
    /**
     * Delete one result
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool
    {
        $this->execute('DELETE FROM user_groups WHERE user_id = ' . $id);
        
        return parent::delete($id);
    }
    
    /**
     * Find or fail one result
     * 
     * @param int $id
     * @return mixed
     */
    public function findOrFail(int $id)
    {
        $user = parent::findOrFail($id);
        
        $query = 'SELECT g.id FROM groups as g, user_groups as ug WHERE g.id = ug.group_id AND ug.user_id = ' . $user->id;
    
        foreach ($this->get($query) as $group) {
            $user->groups[] = $group['id'];
        }
        
        return $user;
    }
}