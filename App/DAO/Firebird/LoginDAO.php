<?php

namespace App\DAO\Firebird;

class LoginDAO extends FirebirdConnection
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }

    public function loginAluno($COD_ALUNO, $SENHA)
    {
        $sql = "SELECT COD_ALUNO, NOME_ALUNO, SENHA FROM aluno WHERE COD_ALUNO = :COD_ALUNO AND SENHA = :SENHA";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_ALUNO" => $COD_ALUNO,
            "SENHA" => $SENHA
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loginInstrutor($COD_INSTRUTOR, $SENHA)
    {
        $sql = "SELECT * FROM instrutor WHERE COD_INSTRUTOR = :COD_INSTRUTOR AND SENHA = :SENHA";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "COD_INSTRUTOR" => $COD_INSTRUTOR,
            "SENHA" => $SENHA
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
