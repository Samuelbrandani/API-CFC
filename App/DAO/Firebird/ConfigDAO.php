<?php

namespace App\DAO\Firebird;

class ConfigDAO extends FirebirdConnection
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }

    public function getBaseConfigs()
    {
        $sql = "SELECT * FROM configuracoes";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
