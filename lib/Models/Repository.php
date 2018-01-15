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
     * Delete one result
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool
    {
        $query = 'DELETE FROM ' . $this->entity->table . ' WHERE ' . $this->entity->primary_key . ' = ' . $id;
        
        return $this->database->query($query)->execute();
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
            $field = $info['Field'];
            $setters[$field] = $field . " = '" . $data[$field] . "'";
        }
        
        $setters['updated_at'] = "updated_at = '" . date('Y-m-d H:i:s') . "'";
        
        $query = 'UPDATE ' . $this->entity->table . ' SET ' . implode($setters, ', ') . ' WHERE ' . $this->entity->primary_key . ' = ' . $id;
        
        return $this->database->query($query)->execute();
    }
    
    /**
     * Create new register
     * 
     * @param array $data
     * @return object
     */
    public function create(array $data)
    {
        $setters = [];
        $table   = $this->database->query('DESCRIBE ' . $this->entity->table)->get();
        
        foreach ($table as $info) {
            $field = $info['Field'];
            $setters[$field] = ($data[$field]) ? "'" . $data[$field] . "'" : 'null';
        }
        
        $setters['created_at'] = "'" . date('Y-m-d H:i:s') . "'";
        $setters['updated_at'] = "'" . date('Y-m-d H:i:s') . "'";
        
        $query = 'INSERT INTO ' . $this->entity->table . ' (' . implode(array_keys($setters), ', ') . ') VALUES (' . implode($setters, ', ') . ')';
        
        return $this->database->query($query)->execute();
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
        $reflection = new ReflectionClass($this->entity);
        
        foreach ($reflection->getProperties() as $prop) {
            $attribute = $prop->getName();
            
            if (array_key_exists($attribute, $data)) {
                $this->entity->$attribute = $data[$attribute];
            }
        }
        
        return $this->entity;
    }
}