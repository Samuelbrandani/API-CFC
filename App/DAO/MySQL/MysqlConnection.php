<?php

namespace App\DAO\MySQL;

abstract class MysqlConnection
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['server']};dbname={$config['database_name']};port=3306;charset=UTF8";
        $this->pdo = new \PDO($dsn, $config['username'], $config['password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}
