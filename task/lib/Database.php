<?php

namespace CWeb;

use PDO;
use Exception;

class Database
{
    const QUERY_TYPE_UNKNOWN = 0;
    const QUERY_TYPE_SELECT = 1;
    const QUERY_TYPE_INSERT = 2;
    const QUERY_TYPE_UPDATE = 3;
    const QUERY_TYPE_DELETE = 4;
    const QUERY_TYPE_SHOW = 5;
    const QUERY_TYPE_DESC = 6;
    
    /**
     * Singleton instance
     * 
     * @var \CWeb\Database
     */
    protected static $instance;
    
    /**
     * Database handler
     * 
     * @var \PDO
     */
    protected $handler;
    
    /**
     * Database statement
     * 
     * @var \PDOStatement
     */
    protected $statement;
    
    /**
     * Get instance
     * 
     * @return \CWeb\Database
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    /**
     * Connect to database
     * 
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $database
     * @param int $port
     * @return \CWeb\Database
     */
    public function connect($host, $user, $pass, $database, $port)
    {
        $this->handler = new PDO('mysql:dbname='. $database .';host='. $host, $user, $pass, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ));
        return $this;
    }
    
    /**
     * Query database
     * 
     * @param string $query
     * @param array $bindings
     * @return mixed
     */
    public function query($query, array $bindings = array())
    {
        $queryType = static::getQueryType($query);
        $this->statement = $this->handler->prepare($query);
        
        if (!$this->statement) {
            throw new Exception('Invalid statement');
        }
        
        $queryResult = $this->statement->execute($bindings);
        
        if ($queryType == static::QUERY_TYPE_SELECT ||
            $queryType == static::QUERY_TYPE_SHOW ||
            $queryType == static::QUERY_TYPE_DESC)
        {
            return $this->statement->fetchAll();
        }
        else if ($queryType == static::QUERY_TYPE_INSERT)
        {
            return $this->handler->lastInsertId();
        }
        
        return $queryResult;
    }
    
    /**
     * Get query type
     *
     * Query type is determined based on specific string,
     * stripos is used to detect the specific string.
     *
     * @static
     * @param string $query SQL query
     * @return integer Query type constant
     */
    public static function getQueryType($query)
    {
        if (false !== stripos($query, 'select'))
        {
            return self::QUERY_TYPE_SELECT;
        }
        else if (false !== stripos($query, 'insert'))
        {
            return self::QUERY_TYPE_INSERT;
        }
        else if (false !== stripos($query, 'update'))
        {
            return self::QUERY_TYPE_UPDATE;
        }
        else if (false !== stripos($query, 'delete'))
        {
            return self::QUERY_TYPE_DELETE;
        }
        else if (false !== stripos($query, 'show'))
        {
            return self::QUERY_TYPE_SHOW;
        }
        else if (false !== stripos($query, 'desc'))
        {
            return self::QUERY_TYPE_DESC;
        }
        return self::QUERY_TYPE_UNKNOWN;
    }
}
