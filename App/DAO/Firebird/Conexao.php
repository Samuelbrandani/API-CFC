<?php

namespace App\DAO\Firebird;

abstract class Conexao
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct($cfc)
    {
        $conn   = $this->getTheConnection($cfc);
        $host   = $conn["server"];
        $port   = $conn["port"] ?? '3050';
        $dbname = $conn["database_name"]; // full path, e.g. /var/data/MYCFC.FDB
        $user   = $conn["username"];
        $pass   = $conn["password"];

        $dsn = "firebird:dbname={$host}/{$port}:{$dbname};charset=UTF8";
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }

    public function getTheConnection($cfc)
    {
        switch ($cfc) {
            // Add Firebird CFC connections here following the same pattern:
            // case 'hash-do-cfc':
            //     return [
            //         'database_name' => '/path/to/database.fdb',
            //         'server'        => '127.0.0.1',
            //         'port'          => '3050',
            //         'username'      => 'SYSDBA',
            //         'password'      => 'password',
            //     ];
        }
    }
}
