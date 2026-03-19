<?php

namespace App\DAO\Firebird;

class InstrutorDAO extends FirebirdConnection
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }

    public function getClassesOfTheDay($INSTRUTOR, $DATA)
    {
        $sql = "SELECT * FROM AULAS_INSTRUTOR WHERE COD_INSTRUTOR = :INSTRUTOR AND DATA_AULA = :DATA ORDER BY HORA_AULA";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "INSTRUTOR" => $INSTRUTOR,
            "DATA"      => $DATA,
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getClassesPeriod($INSTRUTOR, $DATA, $DATA2)
    {
        $sql = "SELECT * FROM AULAS_INSTRUTOR WHERE COD_INSTRUTOR = :INSTRUTOR AND DATA_AULA >= :DATA AND DATA_AULA <= :DATA2 ORDER BY DATA_AULA, HORA_AULA";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "INSTRUTOR" => $INSTRUTOR,
            "DATA"      => $DATA,
            "DATA2"     => $DATA2,
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAdmInstrutor()
    {
        $sql = "SELECT * FROM INSTRUTOR";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
