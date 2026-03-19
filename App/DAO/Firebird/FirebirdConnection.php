<?php

namespace App\DAO\Firebird;

abstract class FirebirdConnection
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct(array $config)
    {
        $port = $config['port'] ?? '3050';
        $dsn  = "firebird:dbname={$config['server']}/{$port}:{$config['database_name']};charset=UTF8";
        $this->pdo = new \PDO($dsn, $config['username'], $config['password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}
