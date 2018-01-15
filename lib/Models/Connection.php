<?php 

namespace Lib\Models;

use PDO;

class Connection
{
	/**
	 * Host name of this connection
	 * 
	 * @var string
	 */ 
	private $host;
    
	/**
	 * Database name of this connection
	 * 
	 * @var string
	 */ 
	private $database;
	
	/**
	 * Charset type of this connection
	 * 
	 * @var string
	 */ 
	private $charset;
	
	/**
	 * User name of this connection
	 * 
	 * @var string
	 */ 
	private $user;
	
	/**
	 * Pass of this connection
	 * 
	 * @var string
	 */ 
	private $pass;
	
	/**
     * Make new instance of this class
     * 
     * @return void
	 */
	public function __construct()
	{
		$this->setAttributes();
	}
	
	/**
     * Accomplish the connection with database
     * 
	 * @return \PDO
     */	
	public function connect()
	{
		try {
		    $conn = new PDO("mysql:host=$this->host;dbname=$this->database; charset=$this->charset", $this->user, $this->pass);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		    var_dump($e);
		    die;
		}
		
		return $conn;
	}
	
    /**
     * Unset the connection with database
     * 
	 * @param PDO
	 * @return void
     */	
	public function disconnect(PDO $conn)
	{
		$conn = null;
	}
	
    /**
     * Set the attributes of this class
     *
	 * @return void
     */	
	private function setAttributes()
	{
		$config_connection = config('database');
		
		$this->host		= $config_connection['host'];
		$this->user		= $config_connection['user'];
		$this->pass		= $config_connection['pass'];
		$this->charset	= $config_connection['charset'];
		$this->database = $config_connection['database'];
	}
}