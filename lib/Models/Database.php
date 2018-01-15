<?php

namespace Lib\Models;

use Lib\Models\Connection;

class Database extends Connection
{
    /**
     * @var string
     */
    private $query;
    
    /**
     * @var \PDO
     */
    private $connection;
    
    /**
     * Set query
     * 
     * @param string $query
     * @return $this
     */
    public function query(string $query)
    {
        $this->query = $query;
        
        return $this;
    }
    
    /**
     * Find all registers
     * 
     * @return array
     */
    public function get() : array
    {
        $pdo = $this->getConnection();
        
        $result = $pdo->query($this->query)->fetchAll(\PDO::FETCH_ASSOC);
        
        $this->disconnect($pdo);
        
        return $result;
    }
    
    /**
     * Find one register
     * 
     * @return array
     */
    public function find() : array
    {
        $pdo = $this->getConnection();
        
        $result = $pdo->query($this->query)->fetch(\PDO::FETCH_ASSOC);
        
        $this->disconnect($pdo);
        
        return $result;
    }
    
    /**
     * Execute query
     * 
     * return bool
     */
	public function execute() : bool
    {
        $pdo = $this->getConnection();
        
        $result = $pdo->prepare($this->query)->execute();
        
        $this->disconnect($pdo);
        
        return $result;
    }
    
    /**
     * Get last insert ID
     * 
     * @return int
     */
    public function lastInsertId() : int
    {
        $pdo = $this->getConnection();
        
        $result = $pdo->lastInsertId();
        
        $this->disconnect($pdo);
        
        return $result;
    }
    
    /**
     * Get connection
     * 
     * @return \PDO
     */
    private function getConnection()
    {
        if (!$this->connection) {
            $this->connection = $this->connect();
        }
        
        return $this->connection;
    }
}