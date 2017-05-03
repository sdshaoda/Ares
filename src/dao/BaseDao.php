<?php

namespace Ares\Dao;

/**
 * Class BaseDao
 * Singleton
 * 连接数据库，得到实例化后的PDO
 */
class BaseDao
{
    protected $host;
    protected $port;
    protected $user;
    protected $password;
    protected $dbname;
    protected $charset;

    protected $dsn;
    protected $dbh;

    protected static $instance;

    /**
     * BaseDao constructor.
     * @param array $config database's config
     */
    protected function __construct($config = array())
    {

        $this->host = isset($config['host']) ? $config['host'] : 'localhost';
        $this->port = isset($config['port']) ? $config['port'] : '3306';
        $this->user = isset($config['user']) ? $config['user'] : 'root';
        $this->password = isset($config['password']) ? $config['password'] : 'root';
        $this->dbname = isset($config['dbname']) ? $config['dbname'] : 'ares';
        $this->charset = isset($config['charset']) ? $config['charset'] : 'utf8';

        $this->dsn = "mysql:host={$this->host};post={$this->port};dbname={$this->dbname};charset={$this->charset}";

        // 连接到MySQL
        try{
            $this->dbh = new \PDO($this->dsn, $this->user, $this->password);
        }catch (\PDOException $e){
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

//        if (isset($config['debug']) && ($config['debug'] == 'Y')) {
//            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//        }
    }

    /**
     * 析构函数 unset()
     * 关闭MySQL连接
     */
    public function __destruct()
    {
        $this->dbh = null;
    }

    public static function getInstance($config = array())
    {
        if(empty(self::$instance)){
            self::$instance = new BaseDao($config);
        }
        return self::$instance;
    }
}
