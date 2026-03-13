<?php

namespace App\DAO\Firebird;

class ConfigDAO extends Conexao
{
    public function __construct($cfc)
    {
        parent::__construct($cfc);
    }

    public function getBaseConfigs()
    {
        $sql = "SELECT * FROM configuracoes";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
