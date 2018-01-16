<?php

namespace Lib\Models;

use ReflectionClass;
use Lib\Models\Database;
use Lib\Contracts\Models\Entity as EntityContract;

abstract class Repository
{
    /**
     * @var \Lib\Models\Database
     */
    private $database;
    
    /**
     * @var \Lib\Contracts\Models\Entity as EntityContract
     */
    private $entity;
    
    /**
     * Make new instance of this class
     * 
     * @return void
     */
    public function __construct()
    {
        $this->database = new Database();
        $this->entity   = $this->instanceEntity();
    }
    
    /**
     * Find one result
     * 
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        $query = 'SELECT * FROM ' . $this->entity->table . ' WHERE ' . $this->entity->primary_key . ' = ' . $id;
        
        $data = $this->database->query($query)->find();
        
        return $data ? $this->exchange($data) : false;
    }
    
    /**
     * Find or fail one result
     * 
     * @param int $id
     * @return mixed
     */
    public function findOrFail(int $id)
    {
        $query = 'SELECT * FROM ' . $this->entity->table . ' WHERE ' . $this->entity->primary_key . ' = ' . $id;
        
        $data = $this->database->query($query)->find();
        
        return $data ? $this->exchange($data) : abort(404);
    }
    
    /**
     * Find first result
     * 
     * @return mixed
     */
    public function first()
    {
        $query = 'SELECT * FROM ' . $this->entity->table;
        
        $data = $this->database->query($query)->find();
        
        return $data ? $this->exchange($data) : false;
    }
    
    /**
     * Find all results
     * 
     * @return array
     */
    public function all() : array
    {
        $query = 'SELECT * FROM ' . $this->entity->table;
        
        $result = [];
        $data   = $this->database->query($query)->get();
        
        foreach ($data as $item) {
            $result[] = $this->exchange($item);
        }
        
        return $result;
    }
    
    /**
     * Paginate results
     * 
     * @param int $take
     * @return array
     */
    public function paginate(int $take) : array
    {
        $page  = $_GET['pagina'] ?? 1;
        $page  = ($page === 0) ? 1 : $page;
        $page -= 1;
        $page  = $page * $take;
        
        $query = 'SELECT * FROM ' . $this->entity->table . ' LIMIT ' . $page . ', ' . $take;
        
        $result = [];
        $data   = $this->database->query($query)->get();
        
        foreach ($data as $item) {
            $result[] = $this->exchange($item);
        }
        
        return $result;
    }
    
    /**
     * Delete one result
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool
    {
        $query = 'DELETE FROM ' . $this->entity->table . ' WHERE ' . $this->entity->primary_key . ' = ' . $id;
        
        return $this->execute($query);
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
        $setters = [];
        $table   = $this->database->query('DESCRIBE ' . $this->entity->table)->get();
        
        foreach ($table as $info) {
            if ($info['Key'] !== 'PRI' && $info['Field'] !== 'created_at' && $info['Field'] !== 'updated_at' ) {
                $field = $info['Field'];
                $setters[$field] = $field . " = '" . $data[$field] . "'";
            }
        }
        
        $setters['updated_at'] = "updated_at = '" . date('Y-m-d H:i:s') . "'";
        
        $query = 'UPDATE ' . $this->entity->table . ' SET ' . implode($setters, ', ') . ' WHERE ' . $this->entity->primary_key . ' = ' . $id;
        
        return $this->execute($query);
    }
    
    /**
     * Create new register
     * 
     * @param array $data
     * @return bool
     */
    public function create(array $data) : bool
    {
        $setters = [];
        $table   = $this->database->query('DESCRIBE ' . $this->entity->table)->get();
        
        foreach ($table as $info) {
            $field = $info['Field'];
            $setters[$field] = isset($data[$field]) ? "'" . $data[$field] . "'" : 'null';
        }
        
        $setters['created_at'] = "'" . date('Y-m-d H:i:s') . "'";
        $setters['updated_at'] = "'" . date('Y-m-d H:i:s') . "'";
        
        $query = 'INSERT INTO ' . $this->entity->table . ' (' . implode(array_keys($setters), ', ') . ') VALUES (' . implode($setters, ', ') . ')';
        
        return $this->execute($query);
    }
    
    /**
     * Execute one query
     * 
     * @param strig $query
     * @return bool
     */
    public function execute(string $query) : bool
    {
        return $this->database->query($query)->execute();
    }
    
    /**
     * Get registers query
     * 
     * @param strig $query
     * @return mixed
     */
    public function get(string $query)
    {
        return $this->database->query($query)->get();
    }
    
    /**
     * Get last id
     * 
     * @return int
     */
    public function lastID() : int
    {
        return $this->database->lastInsertId();
    }
    
    /**
     * Get instance entity
     * 
     * @return \Lib\Contracts\Models\Entity as EntityContract
     */
    private function instanceEntity()
    {
        $class  = $this->getEntity();
        
        return new $class();
    }
    
    /**
     * Exchange one register
     * 
     * @param array $data
     * @return \Lib\Contracts\Models\Entity as EntityContract
     */
    private function exchange(array $data)
    {
        $entity = new $this->entity;
        
        $reflection = new ReflectionClass($entity);
        
        foreach ($reflection->getProperties() as $prop) {
            $attribute = $prop->getName();
            
            if (array_key_exists($attribute, $data)) {
                $entity->$attribute = $data[$attribute];
            }
        }
        
        return $entity;
    }
}